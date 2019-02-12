<?php
require_once 'classes/Database.php';

class DatabaseObject
{
	protected $Database;

	/* DB Fields */
	protected $field_id;

	public function __construct($Database = null)
	{
		$this->Database = ($Database !== null) ? $Database : new Database();
	}

	public function __get($property)
	{
		return $this->{ 'field_' . $property };
	}

	public function __set($property, $value)
	{
		$this->{ 'field_' . $property } = $value;
		return $this->{ 'field_' . $property };
	}

	protected function insertQuery($query, $binds)
	{
		$stmt = $this->Database->prepare($query);
                $stmt->execute($binds);
		$this->field_id = $this->Database->lastInsertId();
	}

	protected function updateQuery($query, $binds)
	{
		$stmt = $this->Database->prepare($query);
                $stmt->execute($binds);
	}

	protected function existsQuery($query, $binds)
	{
		$stmt = $this->Database->prepare($query);
		$stmt->execute($binds);
		return ($stmt->rowCount() > 0);
	}
}