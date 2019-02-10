<?php
require_once 'classes/Token.php';
require_once 'scripts/json.php';

function GET()
{
	if (!isset($_GET['id'], $_GET['service']))
		die(jsonError("Mandatory parameter not given"));
	$Token = new Token();
	$Token->loadByLoginAndServiceId('Foo', 'Imgur');
	echo jsonMsg("token", $Token->token);
}