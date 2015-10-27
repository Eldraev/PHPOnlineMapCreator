<?php

class OptionsView {
	
	public function __construct() {
	
	}
	
	// This creates a form to submit all data used to create a new map
	public function renderOptions() {
		return '<form  method="post" >
			<input type="submit" name="createBtn" value="Create New Map"/>
				<h4>Magnitude (Scale of the map)</h4><input id="OptionsView::Slider1" type="range" min="10" max="50" step="1" name="OptionsView::Slider1" value="'.$this->getPostSlider1Value().'"/>
				<h4>Roughness</h4><input id="OptionsView::Slider2" type="range" min="0" max="1" step="0.1" name="OptionsView::Slider2" value="'.$this->getPostSlider2Value().'"/>
				'//<h4>Amplitude</h4><input id="OptionsView::Slider3" type="range" min="1" max="11" step="1" name="OptionsView::Slider3" value="'.$this->getPostSlider3Value().'"/>
				.'<h4>Level</h4><input id="OptionsView::Slider4" type="range" min="-0.9" max="0.5" step="0.1" name="OptionsView::Slider4" value="'.$this->getPostSlider4Value().'"/>
				<h4>Town Density</h4><input id="OptionsView::Slider5" type="range" min="0" max="0.8" step="0.1" name="OptionsView::Slider5" value="'.$this->getPostSlider5Value().'"/>
				<h4>Seed</h4><input id="seed" type="text" name="OptionsView::Seed" value="'.$this->getPostSeed().'"/> </br> </br>
				</form>';
	}
	
	// Getters
	public function getPostSlider1Value() {
		if(isset($_POST['OptionsView::Slider1']))
			return $_POST['OptionsView::Slider1'];
		else return 30;
	}
	
	public function getPostSlider2Value() {
		if(isset($_POST['OptionsView::Slider2']))
			return $_POST['OptionsView::Slider2'];
		else return 0.5;
	}
	
	public function getPostSlider3Value() {
		if(isset($_POST['OptionsView::Slider3']))
			return $_POST['OptionsView::Slider3'];
		else return 6;
	}
	
	public function getPostSlider4Value() {
		if(isset($_POST['OptionsView::Slider4']))
			return $_POST['OptionsView::Slider4'];
		else return -0.2;
	}
	
	public function getPostSlider5Value() {
		if(isset($_POST['OptionsView::Slider5']))
			return $_POST['OptionsView::Slider5'];
		else return 0;
	}
	
	public function getPostSeed() {
		if(isset($_POST['OptionsView::Seed']))
			return $_POST['OptionsView::Seed'];
		else return "Seed Here";
	}
	
}