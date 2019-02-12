<?php
require_once 'classes/api/ImgurAPI.php';
require_once 'scripts/json.php';

/* example */
function GET()
{
	try {
		$ImgurAPI = new ImgurAPI();
		$res = $ImgurAPI->req_accountGalleryFavorites();
		echo jsonMsg(null, $res);
	}
	catch (Exception $e) {
		echo jsonError($e->getMessage());
	}
}