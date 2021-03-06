<?php
require_once 'classes/User.php';

function verifyUserToken($Database) /* throw */
{
	if (!isset($_SERVER['HTTP_AUTHORIZATION']))
		throw new Exception('Authorization Header Not Set');
	$User = new User($Database);
	try {
		$User->loadByToken($_SERVER['HTTP_AUTHORIZATION']);
	}
	catch (Exception $e) {
		throw new Exception('Invalid AREA User Token');
	}
	return $User;
}