<?php

class AdsController extends Controller {

	public function __construct($request, $data) {
		parent::__construct($request, $data);
	}

	public function create() {
		Response::setSuccessMessage("hello world", ['a' => 1, 'b' => 4]);
	}

	public function edit($id) {

	}
	
	public function relevant() {
		
	}
}