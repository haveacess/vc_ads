<?php

class Response {
	CONST HTTP_OK = 200;
	CONST HTTP_NOT_FOUND = 404;
	CONST HTTP_UNPROCESSABLE_ENTITY = 422;
	
	/**
	 * Set success response message
	 *
	 * @param  string $message Some text, which you want to say to user
	 * @param  array $data For example: info about new/edited object or any useful information
	 * @return void
	 */
	public static function setSuccessMessage($message, $data=[]) {
		self::setHttpCode(self::HTTP_OK);
		self::setMessage($message, $data);
	}

	
	/**
	 * Set error response message
	 *
	 * @param  string $message Some text, which you want to say to user
	 * @param  array $data Any useful information
	 * @return void
	 */
	public static function setErrorMessage($message, $data=[]) {
		self::setHttpCode(self::HTTP_UNPROCESSABLE_ENTITY);
		self::setMessage($message, $data);
	}
	
	/**
	 * Set not found message
	 *
	 * @param  string $message Message which you want to say if user confused
	 * @return void
	 */
	public static function setNotFoundMessage($message) {
		self::setHttpCode(self::HTTP_NOT_FOUND);
		self::setMessage($message);
	}
	
	/**
	 * Set custom HTTP Code, mostly using for errors
	 *
	 * @param  int $httpCode HTTP_CODE which you wanted to return in response. 
	 * Please, use constants HTTP_*
	 * @return mixed
	 */
	private static function setHttpCode($httpCode) {
		http_response_code($httpCode);
	}
	
	/**
	 * Get custom HTTP Code 
	 *
	 * @return int HTTP Code
	 */
	private static function getHttpCode() {
		return http_response_code();
	}
	
	/**
	 * Set message for response
	 *
	 * @param  string $message Some text, which you want to say to user
	 * @param  array $data Any useful information
	 * @return void
	 */
	private static function setMessage($message, $data=[]) {
		exit(json_encode([
			'message' => $message,
			'code' => self::getHttpCode(),
			'data' => $data
		], JSON_UNESCAPED_UNICODE));
	}
}