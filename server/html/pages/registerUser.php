<?php
require_once 'classes/Database.php';
require_once 'classes/ManageUsers.php';

$username = isset($_GET['username']) ? $_GET['username'] : null;
$email = isset($_GET['email']) ? $_GET['email'] : null;
$pwd = isset($_GET['pwd']) ? $_GET['pwd'] : null;

$db = new Database();
$UserManager = new ManageUsers();

$UserManager->AddUser($db, $username, $email, $pwd);

//Add response

var_dump($UserManager->ListUsers($db));