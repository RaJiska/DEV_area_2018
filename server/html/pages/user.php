<?php
require_once 'classes/User.php';
require_once 'scripts/json.php';

// Connect user and reply user's token
function GET()
{
	if (!isset($_GET['login'], $_GET['pass']))
		die(jsonError("Mandatory parameter not given"));
	$User = new User();
	try {
		$User->loadByLoginAndPass($_GET['login'], $_GET['pass']);
	}
	catch (PDOException $e) {
		die(jsonError("SQL Error: " . $e->getMessage()));
	}
	catch (Exception $e) {
		die(jsonError("Error: " . $e->getMessage()));
	}
	echo jsonMsg("token", $User->token);
}

// Register new user and reply user's token
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
		die(jsonError("SQL Error: " . $e->getMessage()));
	}
	echo jsonMsg("token", $User->token);
}