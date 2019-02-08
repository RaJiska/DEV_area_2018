<?php
require_once 'classes/Database.php';
require_once 'classes/ManageUsers.php';

$UserManager = new ManageUsers();
$db = new Database();

function GET()
{
	$username = isset($_GET['username']) ? $_GET['username'] : null;
	$pwd = isset($_GET['pwd']) ? $_GET['pwd'] : null;
	$UserManager->ConnectUser($db, $username, $pwd);
}

function POST()
{
	$username = isset($_GET['username']) ? $_GET['username'] : null;
	$email = isset($_GET['email']) ? $_GET['email'] : null;
	$pwd = isset($_GET['pwd']) ? $_GET['pwd'] : null;
	$UserManager->AddUser($db, $username, $email, $pwd);
}