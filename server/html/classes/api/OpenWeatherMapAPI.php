<?php
require_once 'classes/api/ServiceAPI.php';

class OpenWeatherMapAPI extends ServiceAPI
{
	const SERVICE_NAME = "OpenWeatherMap";

	function __construct($User, $Database = null)
	{
		parent::__construct(self::SERVICE_NAME, $User, $Database);
		$this->urlBase = 'api.openweathermap.org/data/2.5/weather?units=metric&APPID=' . $GLOBALS['config']['services']['openweathermap']['keyid'];
		// $this->keyId = $GLOBALS['config']['services']['imgur']['keyid'];
		// $this->keySecret = $GLOBALS['config']['services']['imgur']['keysecret'];
	}

	function reqAction_sunInCity()
	{
		$arr = $this->request('&q=Toulouse');
		return $arr;
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
		if ($data)
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		if (($res = curl_exec($ch)) === false)
			throw new Exception(self::SERVICE_NAME . ': Request Error: ' . curl_error($ch));
		curl_close($ch);
		return json_decode($res, true);
	}
}