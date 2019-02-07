<?php
require_once 'classes/Database.php';
require_once 'classes/ManageUsers.php';

$requestType = $_SERVER['REQUEST_METHOD'];
$UserManager = new ManageUsers();
$db = new Database();

switch ($requestType)
{
        case 'GET':
                $username = isset($_GET['username']) ? $_GET['username'] : null;
                $pwd = isset($_GET['pwd']) ? $_GET['pwd'] : null;
                $UserManager->ConnectUser($db, $username, $pwd);
                break;
        case 'POST':
                $username = isset($_GET['username']) ? $_GET['username'] : null;
                $email = isset($_GET['email']) ? $_GET['email'] : null;
                $pwd = isset($_GET['pwd']) ? $_GET['pwd'] : null;
                $UserManager->AddUser($db, $username, $email, $pwd);
                break;
        case 'PUT':
                // Future feature
                break;
        case 'DELETE':
                // Future feature
        default:
                break;
}