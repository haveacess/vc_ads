<?php

class Model {

	protected $table;
	protected $primaryKey;
	private $connect;

	public function __construct($table) {
		$this->connect = mysqli_connect(
			$_ENV['DB_HOST'], 
			$_ENV['DB_USER'], 
			$_ENV['DB_PASSWORD'], 
			$_ENV['DB_DATABASE']
		);

		if (!$this->connect)
			throw new \Exception("Connection Failed: " . mysqli_connect_error());

		$this->table = $table;
	}
	
	/**
	 * select columns in you table
	 *
	 * @param  array $columns All collumns, which need to selected
	 * @param  int $offset (optional) Offset select
	 * @param  int $limit (optional) Limit rows of select
	 * @return array|false Result of select
	 */
	public function select($columns=[], $offset=0, $limit=20) {
		$query = "select %s from %s limit %s, %s";

		return $this->getQueryResult(vsprintf($query, [
			implode(',', $columns),
			$this->table,
			$offset, $limit
		]));
	}
	
	/**
	 * Select row (with columns) by primaryKey in you table
	 *
	 * @param  array $columns All collumns, which need to selected
	 * @param  mixed $primaryKey PrimaryKey value. Example: id
	 * @return array|false Result of select
	 */
	public function selectByPrimary($columns, $primaryKey) {
		$query = "select %s from %s where %s=%s limit 0,1";

		return $this->getQueryResult(vsprintf($query, [
			implode(',', $columns),
			$this->table,
			$this->primaryKey,
			self::getFormattedValue($primaryKey)
		]));
	}
	
	/**
	 * Insert new row in you table
	 *
	 * @param  array $values Key -> Name of column, inserted value
	 * @return bool Result of insert
	 */
	public function insert($values) {
		$query = 'insert into %s (%s) values(%s)';

		$valuesFormatted = array_map(function($value) {
			return self::getFormattedValue($value);
		}, $values);

		return $this->getQueryResult(vsprintf($query, [
			$this->table,
			implode(',', array_keys($values)),
			implode(',', array_values($valuesFormatted))
		]), true);
	}
	
	/**
	 * Update row in you table
	 *
	 * @param  array $values Key -> Name of column, inserted value
	 * @param  mixed $primaryKey PrimaryKey value. This string will be updated
	 * @return bool Result of update
	 */
	public function update($values, $primaryKey) {
		$query = "update " . $this->table;
		$query .= " SET ";

		foreach ($values as $name => $value) {
			$query .= $name . '=' . self::getFormattedValue($value);

			if (next($values) !== false) {
				$query .= ', ';
			}
		}
		$query .= " where " . $this->primaryKey . '=' . self::getFormattedValue($primaryKey);

		return $this->getQueryResult($query, true);
	}
	
	/**
	 * Get formatted value for query
	 *
	 * @param  mixed $value Value for format
	 * @return mixed Formatted value - wrapped in quotes or not
	 */
	protected static function getFormattedValue($value) {
		return is_string($value) ? "'{$value}'" : $value;
	}
	
	/**
	 * Get query result
	 *
	 * @param  string $query Query for database
 	 * @param  bool $ignoreResult (opt.) If you need result of request -> true, otherwise - for info about affected rows - false
	 * @return mixed Result of query (or affected rows)
	 */
	protected function getQueryResult($query, $ignoreResult=false) {
		$result = mysqli_query($this->connect, $query);

		if (!$result)
			return false;

		return !$ignoreResult ? mysqli_fetch_assoc($result) : mysqli_affected_rows($this->connect);
	}
}