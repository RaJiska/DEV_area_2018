<?php
require_once 'classes/api/TwitterAPI.php';
require_once 'scripts/json.php';

/* Only for testing purpose, should be removed */
function POST()
{
	try {
		if (!isset($_POST['token']) || !isset($_POST['tokenSecret']))
			die(jsonError("Mandatory parameter not given"));
		$TwitterAPI = new TwitterAPI();
		$TwitterAPI->loadUserTokens($_POST['token'], $_POST['tokenSecret']);
		// $res = $TwitterAPI->reqReaction_tweet("Hello world");
		$res = $TwitterAPI->reqReaction_userTimeline("VDevSantos");
		echo jsonMsg('response', $content);
	}
	catch (Exception $e) {
		echo jsonError($e->getMessage());
	}
}