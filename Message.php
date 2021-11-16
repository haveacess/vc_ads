<?php

class Message {

	CONST MESSAGES = [
		'general_error' => 'Something is wrong. Please try again later',
		'welcome_message' => "Hello everyone. It's simple API for this project.",
		'message_ok' => 'OK',
		'page_not_found' => 'Page not found',
		'object_not_found' => 'Requsted object not found',
		'object_was_edited' => 'Requested object edited successful',
		'object_was_created' => 'New Object created successful',
		'field_is_required' => 'Field: %s is requried',
		'field_is_invalid' => 'Field: %s is invalid.',
		'created successfully' => 'Success! You record %s was created',
		'edited successfully' => 'Success! You record %s was edited'
	];
	
	/**
	 * Receive some message
	 *
	 * @param  string $name Message name
	 * @return string Received message
	 */
	public static function get($name) {
		return self::MESSAGES[$name] ?? self::MESSAGES['general_error'];
	}
}