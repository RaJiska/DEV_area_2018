<?php
require_once 'classes/DatabaseObject.php';

class User extends DatabaseObject
{
	/* DB Fields */
	protected $field_login;
	protected $field_pass;
	protected $field_token;
	protected $field_enabled = 1;

	function loadByLogin($login)
	{
		$stmt = $this->Database->prepare("SELECT * FROM users WHERE login = ?;");
		$stmt->execute([$login]);
		if (!$stmt->rowCount())
			throw new Exception("User with login " . $login . " does not exist");
		$res = $stmt->fetch();
		$this->field_id = $res['id'];
		$this->field_login = $res['login'];
		$this->field_pass = $res['pass'];
		$this->field_token = $res['token'];
		$this->field_enabled = $res['enabled'];
	}

	function loadById($id) /* throw */
	{
		$stmt = $this->Database->prepare("SELECT * FROM users WHERE id = ?;");
		$stmt->execute([$id]);
		if (!$stmt->rowCount())
			throw new Exception("User with ID " . $id . " does not exist");
		$res = $stmt->fetch();
		$this->field_id = $res['id'];
		$this->field_login = $res['login'];
		$this->field_pass = $res['pass'];
		$this->field_token = $res['token'];
		$this->field_enabled = $res['enabled'];
	}

	function insert() /* throw */
	{
		$this->field_token = bin2hex(random_bytes(32 / 2));
		$this->insertQuery("INSERT INTO users (login, pass, token, enabled) VALUES (?, ?, ?, 1);", array(
			$this->field_login,
			$this->field_pass,
			$this->field_token
		));
	}

	function update() /* throw */
	{
		$this->updateQuery("UPDATE users SET login = ?, pass = ?, token = ?, enabled = ? WHERE id = ?;", array(
			$this->field_login,
			$this->field_pass,
			$this->field_token,
			$this->field_enabled,
			$this->field_id
		));
	}

	function save() /* throw */
	{
		$stmt = $this->Database->prepare("SELECT id FROM users WHERE id = ?;");
		$stmt->execute([$this->id]);
		if ($stmt->rowCount() > 0)
			$this->update();
		else
			$this->insert();
	}
}