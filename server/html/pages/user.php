<?php
require_once 'classes/User.php';
require_once 'scripts/json.php';

function GET()
{
	if (!isset($_GET['login'], $_GET['pass']))
		die(jsonError("Mandatory parameter not given"));
	$User = new User();
	$User->login = $_GET['login'];
	$User->pass = $_GET['pass'];
	try {
		$User->loadByLogin($User->login);
	}
	catch (PDOException $e) {
		die(jsonError("SQL Error: " . $e->getMessage()));
	}
	catch (Exception $e) {
		die(jsonError("Error: " . $e->getMessage()));
	}
	echo jsonMsg("token", $User->token);
}

function POST()
{
	if (!isset($_GET['login'], $_GET['pass']))
		die(jsonError("Mandatory parameter not given"));
	$User = new User();
	$User->login = $_GET['login'];
	$User->pass = $_GET['pass'];
	try {
		$User->insert();
	}
	catch (PDOException $e) {
		die(jsonError("SQL Error: " . $e->getMessage()));
	}
	echo jsonMsg("token", $User->token);
}