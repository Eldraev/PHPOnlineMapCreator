<?php

// Basically a name database
abstract class NameGenerator {
	
	static function generateMapName($seed) {
		srand($seed);
		$ran = rand(0, 10);
		switch($ran) {
			case 0:
				$first = 'Old ';
				break;
			case 1:
				$first = 'New ';
				break;
			case 2:
				$first = 'Small ';
				break;
			case 3:
				$first = 'Under ';
				break;
			case 4:
				$first = '';
				break;
			case 5:
				$first = '';
				break;
			case 6:
				$first = '';
				break;
			case 7:
				$first = '';
				break;
			case 8:
				$first = '';
				break;
			case 9:
				$first = '';
				break;
			case 10:
				$first = '';
				break;
		}
		
		$ran = rand(0, 10);
		switch($ran) {
			case 0:
				$second = 'Fire';
				break;
			case 1:
				$second = 'Hill';
				break;
			case 2:
				$second = 'York';
				break;
			case 3:
				$second = 'Middle';
				break;
			case 4:
				$second = 'May';
				break;
			case 5:
				$second = 'Troll';
				break;
			case 6:
				$second = 'Gnom';
				break;
			case 7:
				$second = 'Random';
				break;
			case 8:
				$second = 'Maple';
				break;
			case 9:
				$second = 'Oak';
				break;
			case 10:
				$second = 'Ham';
				break;
		}
		
		$ran = rand(0, 10);
		switch($ran) {
			case 0:
				$third = 'heim';
				break;
			case 1:
				$third = 'ton';
				break;
			case 2:
				$third = ' Harbour';
				break;
			case 3:
				$third = 'ville';
				break;
			case 4:
				$third = 'shire';
				break;
			case 5:
				$third = 'gard';
				break;
			case 6:
				$third = 'bul';
				break;
			case 7:
				$third = 'tium';
				break;
			case 8:
				$third = 'ia';
				break;
			case 9:
				$third = 'holm';
				break;
			case 10:
				$third = 'port';
				break;
		}
		
		return $first.$second.$third;
		
	}
}