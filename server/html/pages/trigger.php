<?php
require_once 'classes/Database.php';
require_once 'classes/Service.php';
require_once 'classes/Trigger.php';
require_once 'classes/User.php';
require_once 'scripts/user.php';

/*
	mandatory params: action_service, reaction_service, action, reaction
	optional: action_params, reaction_params => (base64(param1);base64(param2);base64(paramX))
*/
function POST()
{
	if (!isset($_POST['action_service'], $_POST['reaction_service'], $_POST['action'], $_POST['reaction']))
		die(jsonError("Mandatory parameter not given"));
	try {
		$Database = new Database();
		$User = verifyUserToken($Database);
		$ServiceAction = new Service($Database);
		$ServiceAction->loadByName($_POST['action_service']);
		$ServiceReaction = new Service($Database);
		$ServiceReaction->loadByName($_POST['reaction_service']);
		//var_dump(($_POST['action'], $GLOBALS['config']['actions']['actions_name'][$ServiceAction->name]));
		//var_dump(array_key_exists($_POST['reaction'], $GLOBALS['config']['reactions']['reactions_name'][$ServiceReaction->name]));
		if (array_search($_POST['action'], $GLOBALS['config']['actions']['actions_name'][$ServiceAction->name]) === false ||
			array_search($_POST['reaction'], $GLOBALS['config']['reactions']['reactions_name'][$ServiceReaction->name]) === false)
			die(jsonError("Invalid Action Or Reaction"));
		$Trigger = new Trigger($Database);
		$Trigger->user_id = $User->id;
		$Trigger->action_service_id = $ServiceAction->id;
		$Trigger->reaction_service_id = $ServiceReaction->id;
		$Trigger->action = $_POST['action'];
		$Trigger->reaction = $_POST['reaction'];
		if (isset($_POST['action_params']))
			$Trigger->action_params = $_POST['action_params'];
		if (isset($_POST['reaction_params']))
			$Trigger->reaction_params = $_POST['reaction_params'];
		$Trigger->insert();
	}
	catch (Exception $e) {
		die(jsonError($e->getMessage()));
	}
}

function DELETE()
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
		$Trigger->enabled = false;
		$Trigger->update();
	}
	catch (Exception $e) {
		die(jsonError($e->getMessage()));
	}
}