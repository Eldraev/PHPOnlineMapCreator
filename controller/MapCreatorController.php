<?php

require_once $_SERVER['DOCUMENT_ROOT'].'view/OptionsView.php';
require_once $_SERVER['DOCUMENT_ROOT'].'model/Map.php';

class MapCreatorController {

	private $ov;
	private $map;

	public function __construct(OptionsView $optView) {
		$this->ov = $optView;
		//$this->map = $this->createMap();
	}
	
	public function createMap() {
		// Gather input from view set default values if nothing is set
		$mag = $this->ov->getPostSlider1Value();
		if($mag == NULL)
			$mag = 30;
		$rough = $this->ov->getPostSlider2Value();
		if($rough == NULL)
			$rough = 0.5;
		$amp = $this->ov->getPostSlider3Value();
		if($amp == NULL)
			$amp = 5;
		$lvl = $this->ov->getPostSlider4Value();
		if($lvl == NULL)
			$lvl = -0.2;
		$td = ($this->ov->getPostSlider5Value()-1)*-1;
		if($td == NULL)
			$td = 1;
		$s = $this->ov->getPostSeed();
		if($s == NULL)
			$s = 'Seed Here';
		
		// create objects from model to use the data
		$m = new Map($mag, $rough, $amp, $lvl, $s, $td);
		
		$this->map = $m;
		
		// return the map created from the input
		return $m;
	}
	
	public function getMapName() {
		return NameGenerator::generateMapName($this->getSeedNumeric($this->ov->getPostSeed())+$this->ov->getPostSlider2Value()*10+$this->ov->getPostSlider4Value()*10+14);
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

}