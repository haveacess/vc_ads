<?php

class Controller {

	protected $request;

	public function __construct($request, $data=[]) {
		$this->request = new Request($request, $data);
	}

	public function index() {
		Response::setSuccessMessage(Message::get('welcome_message'));
	}

	public function error404() {
		Response::setNotFoundMessage(Message::get('page_not_found'));
	}
}