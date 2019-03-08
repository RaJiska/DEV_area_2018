<?php
require_once 'classes/api/ServiceAPI.php';

class TrelloAPI extends ServiceAPI
{
	const SERVICE_NAME = "Trello";

	function __construct($User, $Database = null)
	{
		parent::__construct(self::SERVICE_NAME, $User, $Database);
		$this->urlBase = 'https://api.trello.com/';
		$this->keyId = $GLOBALS['config']['services']['trello']['keyid'];
		$this->keySecret = $GLOBALS['config']['services']['trello']['keysecret'];
	}

	function reqReaction_createBoard($argsArr) : bool /* $boardName */
	{
		return $this->request('1/boards/?name=' . $argsArr[0] . '&key=' . $this->keyId . '&token=' . $this->Token->token, 'POST');
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
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if ($status >= 400 && $status < 500)
			throw new Exception(self::SERVICE_NAME . ': Response Error: ' . $res);
		return json_decode($res, true);
	}
}