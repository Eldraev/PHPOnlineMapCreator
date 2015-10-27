<?php
require_once 'View\LayoutView.php';
require_once 'View\ImageView.php';
require_once 'View\OptionsView.php';
require_once 'Model\NameGenerator.php';
require_once 'Controller\MapCreatorController.php';

// Create and initialize view objects in correct order
$ov = new OptionsView();

$controller = new MapCreatorController($ov);

$iv = new ImageView($controller->createMap()->getMapArray());
$lv = new LayoutView();

// Let the layout view render all other elements
$lv->render($iv, $ov, $controller->getMapName());
?>