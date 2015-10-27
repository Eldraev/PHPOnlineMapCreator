<?php


class LayoutView {

	public function __construct() {
	
	}

	public function render(ImageView $iv, OptionsView $ov, $name) {
		$out = '<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<title>Map Creator</title>
		</head> 
		<body background="map-574792_1920.jpg" bgcolor="#232323"> <center>
			<h1>Fantasy Map Creator</h1> 
			<h3>Create maps for your own imaginary worlds.</h3>
			<h4>The world of: '.$name.'</h4>
			'.$iv->renderImage().' </br>
			'.$ov->renderOptions().'
		</body>
		</html>
		';
		echo $out;
  }
}
