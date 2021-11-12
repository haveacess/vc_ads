<?php

class Request {

	CONST REQUEST_METHOD_GET = 'GET';
	CONST REQUEST_METHOD_POST = 'POST';
	CONST REQUEST_METHOD_OPTIONS = 'OPTIONS';
	CONST REQUEST_METHOD_PUT = 'PUT';

	private $request;
	private $query;

	public function __construct($request, $query) {
		$this->request = $request;
		$this->query = $query;
	}

	public function get($name, $defaulValue=null) {
		return $this->query[$name] ?? $defaulValue;
	}

	public function isPost() {
		return $this->request['REQUEST_METHOD'] == self::REQUEST_METHOD_POST;
	}

	public function isGet() {
		return $this->request['REQUEST_METHOD'] == self::REQUEST_METHOD_GET;
	}

	public function isOptions() {
		return $this->request['REQUEST_METHOD'] == self::REQUEST_METHOD_OPTIONS;
	}

	public function isPut() {
		return $this->request['REQUEST_METHOD'] == self::REQUEST_METHOD_PUT;
	}
}