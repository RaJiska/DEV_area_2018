<?php
require_once 'classes/DatabaseObject.php';

class Service extends DatabaseObject
{
	/* DB Fields */
	protected $field_name;

	function loadByName($name)
	{
		$stmt = $this->Database->prepare("SELECT * FROM services WHERE name = ?;");
		$stmt->execute([$name]);
		if (!$stmt->rowCount())
			throw new Exception("Service with specified name doesn't exist");
		$res = $stmt->fetch();
		$this->field_id = $res['id'];
		$this->field_name = $res['name'];
	}

	function insert() /* throw */
        {

		parent::insertQuery("INSERT INTO services (name) VALUES (?);", array(
                        $this->field_name
                ));
        }

        function update() /* throw */
        {
                parent::updateQuery("UPDATE services SET name = ? WHERE id = ?;", array(
                        $this->field_name,
			$this->field_id
                ));
        }
}