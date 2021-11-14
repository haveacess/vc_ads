<?php

class Controller {

	protected $request;

	public function __construct($request, $data=[]) {
		$this->request = new Request($request, $data);
	}

	public function index() {
		Response::setSuccessMessage("Hello everyone. It's simple API for this project. ");
	}

	public function error404() {
		Response::setNotFoundMessage("Page not found");
	}
}