<?php
require_once 'classes/api/ServiceAPI.php';
require 'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterAPI extends ServiceAPI
{
	const SERVICE_NAME = "Twitter";
	private $connection;

	function __construct($User, $Database = null)
	{
		parent::__construct(self::SERVICE_NAME, $User, $Database);
		$this->urlBase = 'https://api.twitter.com/1.1/';
		$this->keyId = $GLOBALS['config']['services']['twitter']['keyid'];
		$this->keySecret = $GLOBALS['config']['services']['twitter']['keysecret'];
		$this->connection = new TwitterOAuth($this->keyId, $this->keySecret, $this->Token->token, $this->Token->token_secret);
	}

	// Return true if there is a recent tweet, false otherwhise.
	function reqAction_newTweet($name = null)
	{
		$name ?
		$content = $this->connection->get("statuses/user_timeline", ["name" => $name[0]]) :
		$content = $this->connection->get("statuses/user_timeline");
		$date = $content[0]->{'created_at'};
		$interval = abs(strtotime('now') - strtotime($date));
		$minutes = $interval / (60);

		if ($minutes <= 1)
			return true;
		return false;
	}

	// Return true if there is a recent follower, false otherwhise.
	function reqAction_newFollower()
	{
		$content = $this->connection->get("followers/list");
		$users = $content->{'users'};
		foreach ($users as &$user) {
			$date = $user->{'created_at'};
			$interval = abs(strtotime('now') - strtotime($date));
			$minutes = $interval / (60);
			if ($minutes <= 1)
				return true;
		}
		return false;
	}

	// Return true if there is a follow request, false otherwhise.
	function reqAction_newFollowerRequest()
	{
		$content = $this->connection->get("friendships/incoming");
		if (!count($content->{'ids'}))
			return false;
		return true;
	}

	// Tweet the tag passed as parameter on user's account
	function reqReaction_tweet($tag)
	{
		$content = $this->connection->post("statuses/update", ["statuss" => $tag]);
		return $this->formatResponse($content);
	}

	private function formatResponse($res)
	{
		if ($res->{'errors'})
			throw new Exception(self::SERVICE_NAME . ': ' . $res->{'errors'}[0]->{'message'});
		return $res;
	}
}