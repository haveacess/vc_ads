<?php

class Controller {

	protected $request;

	public function __construct($request, $data=[]) {
		$this->request = new Request($request, $data);
	}
	
	/**
	 * Default index page
	 *
	 * @return void
	 */
	public function index() {
		Response::setSuccessMessage(Message::get('welcome_message'));
	}
	
	/**
	 * Not found page. If route not found -> all requests will be here
	 *
	 * @return void
	 */
	public function error404() {
		Response::setNotFoundMessage(Message::get('page_not_found'));
	}
}