<?php
require_once 'classes/api/ServiceAPI.php';
require 'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterAPI extends ServiceAPI
{
	const SERVICE_NAME = "Twitter";
	private $accessToken;
	private $accessTokenSecret;
	private $connection;

	function __construct($User, $Database = null)
	{
		parent::__construct(self::SERVICE_NAME, $User, $Database);
		$this->urlBase = 'https://api.twitter.com/1.1/';
		$this->keyId = $GLOBALS['config']['services']['twitter']['keyid'];
		$this->keySecret = $GLOBALS['config']['services']['twitter']['keysecret'];
		$this->connection = new TwitterOAuth($this->keyId, $this->keySecret, $this->Token->token, $this->Token->token_secret);
	}

	// Tweet the tag passed as parameter on user's account
	function reqReaction_tweet($tag)
	{
		$content = $this->connection->post("statuses/update", ["status" => $tag]);
		return $content;
	}

	// Get user tweet timeline
	function reqReaction_userTimeline($name)
	{
		$content = $this->connection->get("statuses/user_timeline", ["name" => $name]);
		return $content;
	}

	private function formatResponse($res)
	{
		if (!$res['success'])
			throw new Exception($res['data']['error']);
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
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $this->Token->token));
		if ($data)
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		if (($res = curl_exec($ch)) === false)
			throw new Exception('Request Error: ' . curl_error($ch));
		curl_close($ch);
		return json_decode($res, true);
	}
}