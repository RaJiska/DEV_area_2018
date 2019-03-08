<?php
require_once 'config/config.php';
require_once 'scripts/triggersFunctions.php';
require_once 'classes/Trigger.php';
require_once 'classes/Service.php';
require_once 'classes/User.php';
require_once 'classes/api/GithubAPI.php';
require_once 'classes/api/ImgurAPI.php';
require_once 'classes/api/OpenWeatherMapAPI.php';
require_once 'classes/api/TrelloAPI.php';
require_once 'classes/api/TwitterAPI.php';
require_once 'classes/api/YammerAPI.php';

try {
	$Database = new Database();
	$res = $Database->query("SELECT * FROM triggers WHERE enabled = 1;");
	while (($row = $res->fetch())) {
		$Trigger = new Trigger($Database);
		$Trigger->fill($row);
		$ServiceAction = new Service($Database);
		$ServiceAction->loadById($Trigger->action_service_id);
		$ServiceReaction = new Service($Database);
		$ServiceReaction->loadById($Trigger->reaction_service_id);
		$User = new User($Database);
		$User->loadById($Trigger->user_id);
		$ActionAPI = new $GLOBALS['config']['api'][$ServiceAction->name]($User, $Database);
		$actionParams = triggerUnpackParams($Trigger->action_params);
		if ($ActionAPI->{ triggerActionByName($ServiceAction->name, $Trigger->action) }($actionParams)) {
			$reactionParams = triggerUnpackParams($Trigger->reaction_params);
			$ReactionAPI = new $GLOBALS['config']['api'][$ServiceReaction->name]($User, $Database);
			$ReactionAPI->{ triggerReactionByName($ServiceReaction->name, $Trigger->reaction) }($reactionParams);
			$Trigger->enabled = 0;
			$Trigger->update();
		}
	}
}
catch (Exception $e) {
	die("Fatal Error: " . $e->getMessage());
}