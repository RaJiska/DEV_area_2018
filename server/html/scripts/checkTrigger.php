<?php
require_once 'config/config.php';
require_once 'scripts/triggersFunctions.php';
require_once 'classes/Trigger.php';

try {
	$Database = new Database();
	$res = $Database->execute("SELECT * FROM triggers WHERE enabled = 1;");
	while (($row = $res->fetch())) {
		$Trigger = new Trigger($Database);
		$Trigger->fill($row);
		$ServiceAction = new Service($Database);
		$ServiceAction->loadById($Trigger->action_service_id);
		$ServiceReaction = new Service($Database);
		$ServiceReaction->loadById($Trigger->reaction_service_id);
		$actionParams = triggerUnpackParams($Trigger->action_params);
		if (triggerActionByName($ServiceAction->name, $Trigger->action)($actionParams)) {
			$reactionParams = triggerUnpackParams($Trigger->reaction_params);
			triggerReactionByName($ServiceReaction->name, $Trigger->reaction)($reactionParams);
		}
	}
}
catch (Exception $e) {
	die("Fatal Error: " . $e->getMessage());
}