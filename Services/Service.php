<?php 

class Service {
	protected $error;
	protected $data;

	public function __construct($data) {
		$this->data = $data;
	}

	protected function setError($message) {
		$this->error = $message;
	}

	protected function getError($message) {
		$this->error = $message;
	}

	public function getData() {
		return $this->data;
	}
}