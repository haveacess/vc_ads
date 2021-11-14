<?php

class Model {

	protected $table;

	public function __construct($table) {
		//init db connection

		$this->table = $table;
	}

	public function get($columns=[], $offset=0, $limit=20) {
		//select explode(',' colums from table)
	}

	public function insert($values) {
		//self::getFormattedValue

		//insert into {$table} (col1, col2, col3) values
	}

	public function update($values) {
		//self::getFormattedValue
	}

	private static function getFormattedValue($value) {
		return is_string($value) ? "'{$value}'" : $value;
	}
}