<?php

use Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php'; 

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

ini_set('display_errors', $_ENV['DEBUG']);
ini_set('display_startup_errors', $_ENV['DEBUG']);
ini_set('error_reporting',$_ENV['DEBUG'] ? -1 : E_ALL);
ini_set("log_errors", 1);

$data = explode('?', $_SERVER['REQUEST_URI']);

$route = $data[0];

$map = include('routes.php');

foreach ($map as $i => &$routeData) {
	if (Request::isEqualRoutes($routeData['route'], $route)) {
		break;
	}
}

$controller = new ("{$routeData['controller']}Controller")($_SERVER, $_REQUEST);
$action = $routeData['action'];

$routeArgs = Request::getRouteArgs($routeData['route'], $route);
$routeArgs ? $controller->$action(...$routeArgs) : $controller->$action();