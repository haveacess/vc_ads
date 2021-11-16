<?php

class Request {

	CONST REQUEST_METHOD_GET = 'GET';
	CONST REQUEST_METHOD_POST = 'POST';
	CONST REQUEST_METHOD_OPTIONS = 'OPTIONS';
	CONST REQUEST_METHOD_PUT = 'PUT';

	CONST ROUTE_PART_SEPARATOR = '/';
	CONST FORMAT_ROUTE_ARG = '/([a-z0-9]+)/m';

	private $request;
	private $query;

	public function __construct($request, $query) {
		$this->request = $request;
		$this->query = $query;
	}
	
	/**
	 * Get value (or default value) from query parametr
	 *
	 * @param  string $name Parametr name
	 * @param  mixed $defaulValue (opt.) If value not will be found, this value will be returned
	 * @return void
	 */
	public function get($name, $defaulValue=null) {
		return $this->query[$name] ?? $defaulValue;
	}
		
	/**
	 * Get all data from query
	 *
	 * @return array
	 */
	public function getData() {
		return $this->query;
	}
	
	/**
	 * Returned true if it is post request
	 *
	 * @return bool
	 */
	public function isPost() {
		return $this->request['REQUEST_METHOD'] == self::REQUEST_METHOD_POST;
	}

	/**
	 * Returned true if it is get request
	 *
	 * @return bool
	 */
	public function isGet() {
		return $this->request['REQUEST_METHOD'] == self::REQUEST_METHOD_GET;
	}
	
	/**
	 * Returned true if it is options request
	 *
	 * @return bool
	 */
	public function isOptions() {
		return $this->request['REQUEST_METHOD'] == self::REQUEST_METHOD_OPTIONS;
	}

	/**
	 * Returned true if it is put request
	 *
	 * @return bool
	 */
	public function isPut() {
		return $this->request['REQUEST_METHOD'] == self::REQUEST_METHOD_PUT;
	}
	
	/**
	 * Compare two routes: route from map, route from user
	 *
	 * @param  array $routeMap You own route in project
	 * @param  mixed $receivedRoute Received route from user
	 * @return bool Bool value - routes is equal or not
	 */
	public static function isEqualRoutes($routeMap, $receivedRoute) {
		$routeMapParts = self::getRouteParts($routeMap);
		$receivedRouteParts = self::getRouteParts($receivedRoute);

		if (count($routeMapParts) != count($receivedRouteParts)) {
			return false;
		}

		foreach($routeMapParts as $i => $part) {
			if (!self::isRouteArgPattern($part) && $part == $receivedRouteParts[$i]) {
				continue;
			}
			if (self::isRouteArgPattern($part) &&
				preg_match(self::FORMAT_ROUTE_ARG, $part) && 
				preg_match(self::FORMAT_ROUTE_ARG, $receivedRouteParts[$i])) {
				continue;
			}

			return false;
		}

		return true;
	}
	
	/**
	 * Get arg-s from route
	 *
	 * @param  array $routeMap You own route in project
	 * @param  mixed $receivedRoute Received route from user
	 * @return array List of arguments
	 */
	public static function getRouteArgs($routeMap, $receivedRoute) {
		$routeMapParts = self::getRouteParts($routeMap);
		$receivedRouteParts = self::getRouteParts($receivedRoute);

		$args = [];
		foreach($routeMapParts as $i => $part) {
			if (!self::isRouteArgPattern($part) && $part == $receivedRouteParts[$i]) {
				continue;
			}

			if (self::isRouteArgPattern($part) &&
				preg_match(self::FORMAT_ROUTE_ARG, $part) && 
				preg_match(self::FORMAT_ROUTE_ARG, $receivedRouteParts[$i])) {
				$args[] = $receivedRouteParts[$i];
			}
		}

		return $args;
	}
	
	/**
	 * Get parts from route. Including removed bad (empty) parts
	 *
	 * @param  string $route Route for decompose
	 * @return array Parts from route
	 */
	private static function getRouteParts($route) {
		$parts = explode(self::ROUTE_PART_SEPARATOR, $route);
		return self::removeBadRouteParts($parts);
	}
	
	/**
	 * Remove all parts which need to ignore
	 *
	 * @param  array $routeParts Route parts
	 * @return array New parts
	 */
	private static function removeBadRouteParts($routeParts) {
		return array_filter($routeParts, function($part) {
			return !empty($part);
		});
	}
	
	/**
	 * Returned if part from route is argument. Example /ads/{id}. Id is argument
	 *
	 * @param  string $part Part
	 * @return bool
	 */
	private static function isRouteArgPattern($part) {
		return str_contains($part, '{') && str_contains($part, '}');
	}
}