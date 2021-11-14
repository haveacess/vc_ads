<?php

class AdsController extends Controller {

	public function __construct($request, $data) {
		parent::__construct($request, $data);
	}
	
	public function relevant() {
		
	}
	
	public function edit() {

	}

	public function test() {
		Response::setSuccessMessage("hello world", ['a' => 1, 'b' => 4]);
	}
}