<?php
require_once 'classes/DatabaseObject.php';

class User extends DatabaseObject
{
        /* DB Fields */
	protected $field_login;
	protected $field_pass;
	protected $field_enabled = 1;

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
                $this->field_enabled = $res['enabled'];
        }

        function insert() /* throw */
        {
                $this->insertQuery("INSERT INTO users (login, pass, enabled) VALUES (?, ?, 1);", array(
                        $this->login,
                        $this->pass
                ));
        }

        function update() /* throw */
        {
                $this->updateQuery("UPDATE users SET login = ?, pass = ?, enabled = ? WHERE id = ?;", array(
                        $this->login,
                        $this->pass,
                        $this->enabled,
                        $this->id
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