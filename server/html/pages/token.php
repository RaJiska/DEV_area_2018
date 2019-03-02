<?php
require_once 'classes/Token.php';
require_once 'classes/User.php';
require_once 'classes/Database.php';
require_once 'classes/Service.php';
require_once 'scripts/json.php';
require_once 'scripts/user.php';

// Get registered token of a service
function GET()
{
	if (!isset($_GET['login'], $_GET['service']))
		die(jsonError("Mandatory parameter not given"));
	try {
		$Database = new Database();
		verifyUserToken($Database);
		$Token = new Token($Database);
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

// Add token to a service
function POST()
{
	if (!isset($_POST['service'], $_POST['service_token']))
		die(jsonError("Mandatory parameter not given"));
	try {
		$Database = new Database();
		$User = verifyUserToken($Database);
		$Service = new Service($Database);
		$Service->loadByName($_POST['service']);
		$Token = new Token($Database);
	}
	catch (PDOException $e) {
		die(jsonError("SQL Error: " . $e->getMessage()));
	}
	catch (Exception $e) {
		die(jsonError("Error: " . $e->getMessage()));
	}
	try {
		$Token->loadByAll($User->id, $Service->id, $_POST['service_token']);
	}
	catch (Exception $e) {
		die(jsonError("Token Already Exists For Service"));
	}
	$Token->user_id = $User->id;
	$Token->service_id = $Service->id;
	$Token->token = $_POST['service_token'];
	try {
		$Token->insert();
	}
	catch (Exception $e) {
		die(jsonError($e->getMessage()));
	}
	echo jsonMsg();
}