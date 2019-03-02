<?php
require_once 'classes/DatabaseObject.php';

class Token extends DatabaseObject
{
	/* DB Fields */
	protected $field_user_id;
	protected $field_service_id;
	protected $field_token;

	function loadByLoginAndService($login, $service)
	{
		$this->loadBy("
			SELECT tokens.* FROM tokens
			LEFT JOIN users ON users.id = tokens.user_id
			LEFT JOIN services ON services.id = tokens.service_id
			WHERE users.login = ?
			AND services.name = ?
			LIMIT 1;",
			[$login, $service]
		);
	}

	function loadByAll($user_id, $service_id, $token)
	{
		$this->loadBy("
			SELECT * FROM tokens
			WHERE user_id = ?
			AND service_id = ?
			AND token = ?
			LIMIT 1;",
			[$user_id, $service_id, $token]
		);
	}

	function insert() /* throw */
        {
		parent::insertQuery("INSERT INTO tokens (user_id, service_id, token) VALUES (?, ?, ?);", array(
                        $this->field_user_id,
			$this->field_service_id,
			$this->field_token
                ));
        }

        function update() /* throw */
        {
                parent::updateQuery("UPDATE tokens SET user_id = ?, service_id = ?, token = ? WHERE id = ?;", array(
                        $this->field_user_id,
			$this->field_service_id,
			$this->field_token,
			$this->field_id
                ));
	}

	function fill($res)
	{
		$this->field_id = $res['id'];
                $this->field_user_id = $res['user_id'];
                $this->field_service_id = $res['service_id'];
		$this->field_token = $res['token'];
	}

	private function loadBy($query, $arr)
	{
		$stmt = $this->Database->prepare($query);
		$stmt->execute($arr);
		if (!$stmt->rowCount())
			throw new Exception("Token not found with given parameters");
		$res = $stmt->fetch();
		$this->fill($res);
	}
}