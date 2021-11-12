<?php

include_once 'Controllers/Controller.php';

class AdsController extends Controller {

	public function __construct($request, $data) {
		parent::__construct($request, $data);
	}
	
	public function relevant() {
		
	}
	
	public function edit() {

	}

	public function test() {
		var_dump($this->request->get('test'));
	}
}