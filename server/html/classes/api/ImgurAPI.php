<?php
require_once 'classes/api/ServiceAPI.php';

class ImgurAPI extends ServiceAPI
{
	const SERVICE_NAME = "Imgur";

	function __construct($Database = null)
	{
		parent::__construct(self::SERVICE_NAME, $Database);
		$this->urlBase = 'https://api.imgur.com';
		$this->keyId = $GLOBALS['config']['services']['imgur']['keyid'];
		$this->keySecret = $GLOBALS['config']['services']['imgur']['keysecret'];
	}

	function req_accountGalleryFavorites() /* throw */
	{
		return $this->formatResponse($this->request('/3/account/me/gallery_favorites'));
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