<?php

require_once $_SERVER['DOCUMENT_ROOT'].'model/MapPointType.php';

class ImageView {

	private $map;
	
	// the handed over $arr should be a 10000 element array
	public function __construct($arr) {
		$this->map = $arr;
	}
	
	// render the image based on the map array it got upon creation.
	public function renderImage() {
		// create the canvas
		$im = imagecreatetruecolor(400, 400);
		
		// allocate the colors. These should be constants later on
		$land_color = imagecolorallocate($im, 140, 255, 100);
		$water_color = imagecolorallocate($im, 100, 150, 255);
		$deepwater_color = imagecolorallocate($im, 50, 100, 255);
		$sand_color = imagecolorallocate($im, 250, 250, 20);
		$rock_color = imagecolorallocate($im, 150, 150, 150);
		$snow_color = imagecolorallocate($im, 255, 255, 255);
		$outline_color = imagecolorallocate($im, 210, 178, 127);
		$text_color = imagecolorallocate($im, 150, 118, 67);
		$city_color = imagecolorallocate($im, 255, 150, 100);
		
		// draw the outline for the map
		imagefilledrectangle ($im , 0 , 0 , 400 , 400 , $outline_color);
		
		// draw cardinal directions on the outlines of the map
		imagestring($im, 6, 197, 17, 'N', $text_color);
		imagestring($im, 6, 196, 367, 'S', $text_color);
		imagestring($im, 6, 22, 193, 'W', $text_color);
		imagestring($im, 6, 372, 193, 'E', $text_color);
		
		imageline($im, 200, 40, 200, 360, $text_color);
		imageline($im, 40, 200, 360, 200, $text_color);
		
		// traverse the map array and draw every point as a rectangle
		for($i=0; $i<100; $i++) {
			for($j=0; $j<100; $j++) {
				switch($this->map[$j+$i*100]) {
					case MapPointType::DeepWater:
						$color = $deepwater_color;
						break;
					case MapPointType::Water:
						$color = $water_color;
						break;
					case MapPointType::Sand:
						$color = $sand_color;
						break;
					case MapPointType::Land:
						$color = $land_color;
						break;
					case MapPointType::Rock:
						$color = $rock_color;
						break;
					case MapPointType::Snow:
						$color = $snow_color;
						break;
					case MapPointType::Undefined:
						$color = $outline_color;
						break;
					case MapPointType::City:
						$color = $city_color;
						break;
				}
				// Draw the map point
				imagefilledrectangle ($im , 50+$j*3 , 50+$i*3 , 50+$j*3+2 , 50+$i*3+2 , $color);
			}
		}
		
		ob_start();
		imagepng($im);
		// Get the image that was supposed to be put to the browser
		$img = ob_get_contents();
		// Clear the output buffer
		ob_end_clean();
		
		// return the image ready to be displayed on the site
		return '<img src="data:image/png;base64,'.base64_encode($img).'" alt="Map cannot be shown for some reason"/>';
	}
}
?>
