<?php
require_once 'classes/Token.php';
require_once 'classes/User.php';
require_once 'classes/Database.php';
require_once 'classes/Service.php';
require_once 'scripts/json.php';

function GET()
{
	if (!isset($_GET['login'], $_GET['service']))
		die(jsonError("Mandatory parameter not given"));
	try {
		$Token = new Token();
		$Token->loadByLoginAndService($_GET['login'], $_GET['service']);
	}
	catch (PDOException $e) {
		die(jsonError("SQL Error: " . $e->getMessage()));
	}
	catch (Exception $e) {
		die(jsonError("Error: " . $e->getMessage()));
	}
	echo jsonMsg("token", $Token->token);
}

function POST()
{
	if (!isset($_POST['service'], $_POST['service_token']))
		die(jsonError("Mandatory parameter not given"));
	if (!isset($_SERVER['HTTP_AUTHORIZATION']))
		die(jsonError('Authorization Header Not Set'));
	try {
		$db = new Database();
		$User = new User($db);
		$User->loadByToken($_SERVER['HTTP_AUTHORIZATION']);
		$Service = new Service($db);
		$Service->loadByName($_POST['service']);
		$Token = new Token($db);
		$Token->loadByAll($User->id, $Service->id, $_POST['service_token']);
	}
	catch (PDOException $e) {
		die(jsonError("SQL Error: " . $e->getMessage()));
	}
	catch (Exception $e) {
		die(jsonError("Error: " . $e->getMessage()));
	}
	echo jsonMsg();
}