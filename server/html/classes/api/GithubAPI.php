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

	function reqAction_newCommit($argsArr) : bool /* $owner, $repo, $time */ /* throw */
	{
		$DateTime = new DateTime('@' . $argsArr['2']);
		$res = $this->request('repos/' . $argsArr[0] . '/' . $argsArr[1] . '/commits?since=' . $DateTime->format(DateTimeInterface::ISO8601));
		return count($res) > 0;
	}

	function reqReaction_starRepo($argsArr) /* $owner, $repo */ /* throw */
	{
		return $this->request('user/starred/' . $argsArr[0] . '/' . $argsArr[1], 'PUT');
	}

	function reqReaction_unstarRepo($argsArr) /* $owner, $repo */ /* throw */
	{
		return $this->request('user/starred/' . $argsArr[0] . '/' . $argsArr[1], 'DELETE');
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
		$headers = array(
			"Authorization: token " . $this->Token->token,
			"User-Agent: Area"
		);
		if ($method == 'PUT')
			array_push($headers, "Content-Length: 0");
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		if ($data)
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		if (($res = curl_exec($ch)) === false)
			throw new Exception(self::SERVICE_NAME . ': Request Error: ' . curl_error($ch));
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if ($status >= 400 && $status < 500)
			throw new Exception(self::SERVICE_NAME . ': Response Error: ' . json_decode($res, true)['message']);
		return json_decode($res, true);
	}
}