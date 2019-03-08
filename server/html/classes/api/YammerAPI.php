<?php
require_once 'classes/api/ServiceAPI.php';

class YammerAPI extends ServiceAPI
{
	const SERVICE_NAME = "Yammer";

	function __construct($User, $Database = null)
	{
		parent::__construct(self::SERVICE_NAME, $User, $Database);
		$this->urlBase = 'https://www.yammer.com/api/v1/';
	}

	// Return true if there is a new thread, false otherwhise.
	function reqAction_newThread($arr)
	{
		$content = $this->request('messages/my_feed.json');
		$messages = $content['messages'];
		foreach ($messages as &$message) {
			$date = $message['created_at'];
			if ($arr[0] > strtotime($date))
				return true;
			// $minutes = $interval / (60);
			// if ($minutes <= 1)
				// return true;
		}
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
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $this->Token->token));
		if ($data)
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		if (($res = curl_exec($ch)) === false)
			throw new Exception(self::SERVICE_NAME . ': Request Error: ' . curl_error($ch));
		curl_close($ch);
		return json_decode($res, true);
	}
}