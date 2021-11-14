<?php

class Message {

	CONST MESSAGES = [
		'general_error' => 'Something is wrong. Please try again later',
		'welcome_message' => "Hello everyone. It's simple API for this project.",
		'page_not_found' => 'Page not found',
		'field_is_required' => 'Field: %s is requried',
		'field_is_invalid' => 'Field: %s is invalid. %s',
		'created successfully' => 'Success! You record %s was created',
		'edited successfully' => 'Success! You record %s was edited'
	];

	public static function get($name) {
		return self::MESSAGES[$name] ?? self::MESSAGES['general_error'];
	}
}