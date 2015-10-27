<?php
require_once 'MapPointType.php';

class Map {
	
	private $map;
	
	public function __construct($magnitude, $roughness, $amplitude, $level, $seed, $townDensity) {
		// get the heightmap
		$map = $this->createHeightmap($magnitude, $roughness, $amplitude, $level, $seed);
		
		// replace the heights with appropriate materials
		for($j=0;$j<100;$j++) {
			for($i=0;$i<100;$i++) {
				if($map[$i+$j*100] < 0.1)
					$map[$i+$j*100] = MapPointType::DeepWater;
				else if($map[$i+$j*100] < 0.3)
					$map[$i+$j*100] = MapPointType::Water;
				else if($map[$i+$j*100] < 0.4)
					$map[$i+$j*100] = MapPointType::Sand;
				else if($map[$i+$j*100] < 0.7)
					$map[$i+$j*100] = MapPointType::Land;
				else if($map[$i+$j*100] < 0.9)
					$map[$i+$j*100] = MapPointType::Rock;
				else if($map[$i+$j*100] >= 0.9)
					$map[$i+$j*100] = MapPointType::Snow;
				else 
					$map[$i+$j*100] = MapPointType::Undefined;
			}
		}
		
		// Get a density map for cities
		$city = $this->createHeightmap($magnitude, 0.4, 1, 0, $seed*-1);
		
		// Take only the cities that fit with the density filter and add them into the map
		for($j=0;$j<100;$j++) {
			for($i=0;$i<100;$i++) {
				if($city[$i+$j*100] > $townDensity) {
					if($map[$i+$j*100] != MapPointType::DeepWater AND $map[$i+$j*100] != MapPointType::Water)
						$map[$i+$j*100] = MapPointType::City;
				}
			}
		}
		
		// Store the map in a member variable
		$this->map = $map;
		
	}
	
	private function createHeightmap($magnitude, $roughness, $amplitude, $level, $seed) {
		$octaves = 4; // this should not be changed unless the complete map creation is overhauled
		
		$seed = $this->getSeedNumeric($seed);
		
		// Generate the basic noise
		$noise = array(10000);
		for($j=0;$j<100;$j++) {
			for($i=0;$i<100;$i++) {
				$noise[$i+$j*100] = $this->Noise($j,$i,$seed);
			}
		}
		
		// Generate a smoothed noise from the previously generated noise
		$arr = array(10000);
		$highest = -10;
		for($j=0;$j<100;$j++) {
			for($i=0;$i<100;$i++) {
				$arr[$i+$j*100] = 0;
				$amp = $amplitude;
				// Smooth out the noise in the previously defined number of octaves
				for($x=0;$x<$octaves;$x++) {
					$arr[$i+$j*100] += $this->BilinearPolate($j/($magnitude/(($x+1)*2)),$i/($magnitude/(($x+1)*2)),$noise)*$amp;
					// lower the amplitude for each octave so it looses impact
					$amp *= $roughness;
				}
				// also save this point if it is the highest point
				if($arr[$i+$j*100] > $highest)
					$highest = $arr[$i+$j*100];
			}
		}
		
		// go through the whole map and lower the values so the range is 0-1 using the highest value in the array
		for($j=0;$j<100;$j++) {
			for($i=0;$i<100;$i++) {
				$arr[$i+$j*100] = $arr[$i+$j*100]/$highest;
				// Raise the entire map by the level parameter
				$arr[$i+$j*100]+=$level;
			}
		}
		
		return $arr;
		
	}
	
	public function getMapArray() {
		return $this->map;
	}
	
	private function Noise($x, $y, $seed) {
		// Create unique seed for every point
		$n = $x*100+$y+$seed;
		// Seed the random generator
		mt_srand($n);
		// Return a Noise between 0 and 1
		return mt_rand()/mt_getrandmax();
	}
	
	private function getSeedNumeric($seed) {
		$result = 0;
		while(strlen($seed)>0) {
			try{
				$result += ord($seed);
			} catch(Exception $e) {
				// just do nothing
			}
			$seed = substr($seed, 1);
		}
		return $result;
	}
	
	private function BilinearPolate($x, $y, $noise) {
   
		// Find the neighbouring pixels
		$x1 = (int)$x;
		$y1 = (int)$y;
		// Make sure we don't try to find a neighbour that doesn't exist
		if(floor($x1)-1<0)
			$x2 = 0;
		else
			$x2 = floor($x1)-1;
		if(floor($y1)-1<0)
			$y2 = 0;
		else
			$y2 = floor($y1)-1;
		
		// Get the fractional part of x and y
		$Xfraction = $x-floor($x);
		$Yfraction = $y-floor($y);

		// take all four points around the point and smooth it out
		$value = 0;
		$value += $Xfraction*$Yfraction*$noise[$x1*100+$y1];
		$value += $Xfraction*(1-$Yfraction)*$noise[$x1*100+$y2];
		$value += (1-$Xfraction)*$Yfraction*$noise[$x2*100+$y1];
		$value += (1-$Xfraction)*(1-$Yfraction)*$noise[$x2*100+$y2];

		return $value;
	}
}