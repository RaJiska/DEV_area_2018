<?php
require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Token.php';

class ServiceAPI
{
	protected $Database;
	protected $User;

	public function __construct($Database = null)
	{
		$this->$Database = ($Database !== null) ? $Database : new Database();
		if (!isset($_SERVER['HTTP_AUTHORIZATION']))
			throw new Exception('Authorization Header Not Set');
		$this->User = new User($Database);
		try {
			$this->User->loadByToken($_SERVER['HTTP_AUTHORIZATION']);
		}
		catch (Exception $e) {
			throw new Exception('Invalid AREA User Token');
		}
	}
}