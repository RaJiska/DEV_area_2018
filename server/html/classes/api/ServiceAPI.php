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

	public function __construct($serviceName, $User, $Database = null, $needToken = true)
	{
		$this->User = $User;
		$this->Token = new Token($this->Database);
		if ($needToken)
			$this->Token->loadByLoginAndService($this->User->login, strtolower($serviceName));
	}
}