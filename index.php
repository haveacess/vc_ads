<?php

include_once 'Controllers/AdsController.php';

$data = explode('?', $_SERVER['REQUEST_URI']);

$route = $data[0];
$query = $data[1] ?? '';

$map[] = ['route' => '/ads', 'controller' => 'Ads', 'action' => 'test'];
$map[] = ['route' => '*', 'controller' => '', 'action' => 'error404'];

foreach ($map as $i => &$routeData) {
	if (in_array($route, [$routeData['route'], "{$routeData['route']}/"])) {
		break;
	}
}

$data = [];
if ($query) {
	$gluedValues = explode('&', $query);

	foreach ($gluedValues as $gluedValue) {
		$keyValue = explode('=', $gluedValue);
		$key = $keyValue[0];
		$value = $keyValue[1];
		$data[$key] = $value;
	}
}


$controller = new ("{$routeData['controller']}Controller")($_SERVER, $data);

$action = $routeData['action'];
$controller->$action();