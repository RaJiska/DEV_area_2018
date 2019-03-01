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
                $this->loadBy("SELECT * FROM users WHERE login = ?;", [$login]);
	}

	function loadById($id) /* throw */
	{
                $this->loadBy("SELECT * FROM users WHERE id = ?", [$id]);
        }

        function loadByToken($token)
        {
                $this->loadBy("SELECT * FROM users WHERE token = ?;", [$token]);
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
	
	function fill($arr)
        {
                $this->field_id = $arr['id'];
		$this->field_login = $arr['login'];
		$this->field_pass = $arr['pass'];
		$this->field_token = $arr['token'];
		$this->field_enabled = $arr['enabled'];
        }

        private function loadBy($query, $arr)
        {
                $stmt = $this->Database->prepare($query);
		$stmt->execute($arr);
		if (!$stmt->rowCount())
			throw new Exception("User with specified data does not exist");
		$res = $stmt->fetch();
		$this->fill($res);
        }
}