<?php
require_once 'classes/api/ServiceAPI.php';

class ImgurAPI extends ServiceAPI
{
	const SERVICE_NAME = "Imgur";

	function __construct($User, $Database = null)
	{
		parent::__construct(self::SERVICE_NAME, $User, $Database);
		$this->urlBase = 'https://api.imgur.com/';
		$this->keyId = $GLOBALS['config']['services']['imgur']['keyid'];
		$this->keySecret = $GLOBALS['config']['services']['imgur']['keysecret'];
	}

	function reqAction_newComment($argsArr) : bool /* $galleryHash, $time */
	{
		$arr = $this->formatResponse($this->request('3/gallery/' . $argsArr[0] . '/comments/new'));
		if (!count($arr))
			return false;
		return $argsArr[1] < $arr[0]['datetime'];
	}

	function reqReaction_followTag($argsArr) /* $tag */ /* throw */
	{
		return $this->formatResponse($this->request('3/account/me/follow/tag/' . $argsArr[0], 'POST'));
	}

	function reqReaction_unfollowTag($argsArr) /* $tag */ /* throw */
	{
		return $this->formatResponse($this->request('3/account/me/follow/tag/' . $argsArr[0], 'DELETE'));
	}

	function reqReaction_comment($argsArr) /* $imageId, $comment) */ /* throw */
	{
		return $this->formatResponse($this->request(
			'3/comment',
			'POST',
			'image_id=' . $argsArr[0] . '&comment=' . $argsArr[1])
		);
	}

	function reqReaction_uncomment($argsArr) /* $commentId */ /* throw */
	{
		return $this->formatResponse($this->request('3/comment/' . $argsArr[0], 'DELETE'));
	}

	function reqReaction_favoriteAlbum($argsArr) /* $albumId */ /* throw */
	{
		return $this->formatResponse($this->request('3/album/' . $argsArr[0] . '/favorite', 'POST'));
	}

	function reqReaction_uploadImage($argsArr) /* $image */ /* throw */
	{
		return $this->formatResponse($this->request(
			'3/image',
			'POST',
			'image=' . $argsArr[0])
		);
	}

	function reqReaction_deleteImage($argsArr) /* $imageId */ /* throw */
	{
		return $this->formatResponse($this->request('3/image/' . $argsArr[0], 'DELETE'));
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
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $this->Token->token));
		if ($data)
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		if (($res = curl_exec($ch)) === false)
			throw new Exception(self::SERVICE_NAME . ': Request Error: ' . curl_error($ch));
		curl_close($ch);
		return json_decode($res, true);
	}
}