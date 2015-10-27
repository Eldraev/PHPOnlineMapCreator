<?php

// This basically serves as an enum
abstract class MapPointType {
	const DeepWater = 0;
	const Water = 1;
	const Sand = 2;
	const Land = 3;
	const Rock = 4;
	const Snow = 5;
	const Undefined = 6;
	const City = 7;
}