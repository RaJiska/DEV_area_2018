<?php
require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Token.php';

class ServiceAPI
{
	protected $Database;
	protected $User;
	protected $Token;
	protected $keyId;
	protected $keySecret;
	protected $urlBase;

	public function __construct($serviceName, $Database = null)
	{
		$this->$Database = ($Database !== null) ? $Database : new Database();
		if (!isset($_SERVER['HTTP_AUTHORIZATION']))
			throw new Exception('Authorization Header Not Set');
		$this->User = new User($this->Database);
		try {
			$this->User->loadByToken($_SERVER['HTTP_AUTHORIZATION']);
		}
		catch (Exception $e) {
			throw new Exception('Invalid AREA User Token');
		}
		$this->Token = new Token($this->Database);
		$this->Token->loadByLoginAndService($this->User->login, $serviceName);
	}
}