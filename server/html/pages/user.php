<?php
require_once 'classes/User.php';
require_once 'scripts/json.php';

function POST()
{
	if (!isset($_POST['login'], $_POST['pass']))
		die(jsonError("Mandatory parameter not given"));
	$User = new User();
	$User->login = $_POST['login'];
	$User->pass = $_POST['pass'];
	try {
		$User->insert();
	}
	catch (PDOException $e) {
		die (jsonError("SQL Error: " . $e->getMessage()));
	}
	echo jsonMsg();
}