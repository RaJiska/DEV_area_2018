<?php
require_once 'config/config.php';

function triggerActionByName($service, $action)
{
	$idx = array_search($action, $GLOBALS['config']['actions']['actions_name'][$service]);
	return $GLOBALS['config']['actions']['actions_function'][$service][$idx];
}

function triggerReactionByName($service, $reaction)
{
	$idx = array_search($reaction, $GLOBALS['config']['reactions']['reactions_name'][$service]);
	return $GLOBALS['config']['reactions']['reactions_function'][$service][$idx];
}

function triggerUnpackParams($params)
{
	$params = explode(";", $Trigger->action_params);
	foreach ($actionParams as &$val)
		$val = base64_decode($val);
	return $params;
}