<?php

class Response {
	CONST HTTP_OK = 200;
	CONST HTTP_NOT_FOUND = 404;
	CONST HTTP_HTTP_UNPROCESSABLE_ENTITY = 422;

	public static function setSuccessMessage($message, $data=[]) {
		self::setHttpCode(self::HTTP_OK);
		self::setMessage($message, $data);
	}

	public static function setErrorMessage($message, $data) {
		self::setHttpCode(self::HTTP_HTTP_UNPROCESSABLE_ENTITY);
		self::setMessage($message, $data);
	}

	public static function setNotFoundMessage($message) {
		self::setHttpCode(self::HTTP_NOT_FOUND);
		self::setMessage($message);
	}

	private static function setHttpCode($httpCode) {
		http_response_code($httpCode);
	}

	private static function setMessage($message, $data=[]) {
		
		exit(json_encode([
			'message' => $message,
			'code' => http_response_code(),
			'data' => $data
		], JSON_UNESCAPED_UNICODE));
	}
}