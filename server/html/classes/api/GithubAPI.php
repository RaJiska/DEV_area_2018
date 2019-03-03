<?php
require_once 'classes/api/ServiceAPI.php';

class GithubAPI extends ServiceAPI
{
	const SERVICE_NAME = "Github";

	function __construct($User, $Database = null)
	{
		parent::__construct(self::SERVICE_NAME, $User, $Database);
		$this->urlBase = 'https://api.github.com/';
		$this->keyId = $GLOBALS['config']['services']['github']['keyid'];
		$this->keySecret = $GLOBALS['config']['services']['github']['keysecret'];
	}

	private function formatResponse($res)
	{
		if (!$res['success'])
			throw new Exception(self::SERVICE_NAME . ': ' . $res['data']['error']);
		return $res['data'];
	}

	private function request($uri, $method = 'GET', $data = null)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->urlBase . $uri);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: token " . $this->Token->token));
		if ($data)
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		if (($res = curl_exec($ch)) === false)
			throw new Exception(self::SERVICE_NAME . ': Request Error: ' . curl_error($ch));
		curl_close($ch);
		return json_decode($res, true);
	}
}