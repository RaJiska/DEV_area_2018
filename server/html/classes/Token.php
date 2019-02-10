<?php
require_once 'classes/DatabaseObject.php';

class Token extends DatabaseObject
{
	/* DB Fields */
	protected $field_id;
	protected $field_user_id;
	protected $field_service_id;
	protected $field_token;

	function loadByLoginAndServiceId($login, $service)
	{
		$stmt = $this->Database->prepare("
			SELECT tokens.* FROM tokens
			LEFT JOIN users ON users.id = tokens.user_id
			LEFT JOIN services ON services.id = tokens.service_id
			WHERE users.login = 'Foo'
			AND services.name = 'Imgur'
			LIMIT 1;"
		);
                $stmt->execute([$login, $service]);
                if (!$stmt->rowCount())
                        throw new Exception("Token not found");
                $res = $stmt->fetch();
                $this->field_id = $res['id'];
                $this->field_user_id = $res['user_id'];
                $this->field_service_id = $res['service_id'];
		$this->field_token = $res['token'];
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
}