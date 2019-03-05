<?php
require_once 'classes/api/ServiceAPI.php';

class OpenWeatherMapAPI extends ServiceAPI
{
	const SERVICE_NAME = "OpenWeatherMap";

	function __construct($User, $Database = null)
	{
		parent::__construct(self::SERVICE_NAME, $User, $Database, false);
		$this->urlBase = 'api.openweathermap.org/data/2.5/weather?units=metric&APPID=' . $GLOBALS['config']['services']['openweathermap']['keyid'];
	}

	function reqAction_rainInCity($city)
	{
		$content = $this->request('&q=' . $city);
		$state = $content['weather'][0]['main'];
		$temp = $content['main']['temp'];
		if ($state == "Rain")
			return true;
		return false;
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