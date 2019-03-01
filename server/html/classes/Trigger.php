<?php
require_once 'classes/DatabaseObject.php';

class Trigger extends DatabaseObject
{
	/* DB Fields */
	protected $field_user_id;
	protected $field_action_service_id;
	protected $field_reaction_service_id;
	protected $field_action;
	protected $field_reaction;
	protected $field_action_params = "";
	protected $field_reaction_params = "";
	protected $field_enabled = true;

	function insert() /* throw */
	{
		parent::insertQuery("
			INSERT INTO triggers
			(user_id, action_service_id, reaction_service_id, action, reaction, action_params, reaction_params, enabled)
			VALUES (?, ?, ?, ?, ?, ?);",
			array(
				$this->field_user_id,
				$this->field_action_service_id,
				$this->field_reaction_service_id,
				$this->field_action,
				$this->field_reaction,
				$this->field_action_params,
				$this->field_reaction_params,
				$this->field_enabled
			)
		);
	}

	function update() /* throw */
        {
                parent::updateQuery("UPDATE triggers SET
			user_id = ?, action_service_id = ?, reaction_service_id = ?, action = ?, reaction = ?, action_params = ?, reaction_params = ?, enabled = ?
			WHERE id = ?;", array(
                        	$this->field_user_id,
				$this->field_action_service_id,
				$this->field_reaction_service_id,
				$this->field_action,
				$this->field_reaction,
				$this->field_action_params,
				$this->field_reaction_params,
				$this->field_enabled,
				$this->field_id
			)
		);
	}

	function fill($arr)
	{
		$this->field_id = $arr['id'];
		$this->field_action_service_id = $arr['action_service_id'];
		$this->field_reaction_service_id = $arr['reaction_service_id'];
		$this->field_action = $arr['action'];
		$this->field_reaction = $arr['reaction'];
		$this->field_action_params = $arr['action_params'];
		$this->field_reaction_params = $arr['reaction_params'];
	}
}