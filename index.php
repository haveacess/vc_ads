<?php

require_once __DIR__ . '/vendor/autoload.php'; 

$data = explode('?', $_SERVER['REQUEST_URI']);

$route = $data[0];
$query = $data[1] ?? '';

$map = include('routes.php');

foreach ($map as $i => &$routeData) {
	if (in_array($route, [$routeData['route'], "{$routeData['route']}/"])) {
		break;
	}
}

$controller = new ("{$routeData['controller']}Controller")($_SERVER, $_REQUEST);

$action = $routeData['action'];
$controller->$action();