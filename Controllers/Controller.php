<?php
include_once 'Request.php';

class Controller {

	protected $request;

	public function __construct($request, $data=[]) {
		$this->request = new Request($request, $data);
	}

	public function index() {

	}
}