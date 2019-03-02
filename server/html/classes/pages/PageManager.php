<?php
require_once 'classes/pages/PageHTML.php';
require_once 'classes/pages/PageJSON.php';

class PageManager
{
	private $Page;

	public function retrieve($page)
	{
		switch ($page)
		{
		case null:
			$this->Page = new PageHTML('', 'pages/home.php', "test");
			break;
		case 'about':
			$this->Page = new PageJSON('About', 'pages/about.php', null);
			break;
		case 'user':
			$this->Page = new PageJSON('user', 'pages/user.php');
			break;
		case 'token':
			$this->Page = new PageJSON('token', 'pages/token.php');
			break;
		case 'services':
			$this->Page = new PageJSON('services', 'pages/services.php');
			break;
		default:
			$this->Page = new PageHTML('404', 'pages/status/404.php');
		}
		$this->Page->display();
	}
}