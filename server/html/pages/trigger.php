<?php
require_once 'classes/Database.php';
require_once 'classes/Service.php';
require_once 'classes/Trigger.php';

function POST()
{
	if (!isset($_POST['action_service'], $_POST['reaction_service'], $_POST['action'], $_POST['reaction']))
		die(jsonError("Mandatory parameter not given"));
	try {
		$Database = new Database();
		$ServiceAction = new Service($Database);
		$ServiceAction->loadByName($_POST['action_service']);
		$ServiceReaction = new Service($Database);
		$ServiceReaction->loadByName($_POST['reaction_service']);
		if (!array_key_exists($_POST['action'], $GLOBALS['config']['actions']['actions_name'][strtolower($ServiceAction->name)]) ||
			!array_key_exists($_POST['reaction'], $GLOBALS['config']['reaction']['reactions_name'][strtolower($ServiceAction->name)]))
			die(jsonError("Invalid Action Or Reaction"));
		$Trigger = new Trigger($Database);
		$Trigger->action_service_id = $ServiceAction->id;
		$Trigger->reaction_service_id = $ServiceReaction->id;
		$Trigger->action = $_POST['action'];
		$Trigger->reaction = $_POST['reaction'];
		if (isset($_POST['action_params']))
			$Trigger->action_params = $_POST['action_params'];
		if (isset($_POST['reaction_params']))
			$Trigger->reaction_params = $_POST['reaction_params'];
		/* TODO: Check for duplicate before inserting */
		$Trigger->insert();
	}
	catch (Exception $e) {
		die(jsonError($e->getMessage()));
	}
}