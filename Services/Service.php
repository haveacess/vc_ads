<?php 

class Service {
	protected $error;
	protected $data;

	public function __construct($data=[]) {
		$this->data = $data;
	}

	protected function setError($message) {
		$this->error = $message;
	}

	public function getError() {
		return $this->error;
	}

	public function getData() {
		return $this->data;
	}
}