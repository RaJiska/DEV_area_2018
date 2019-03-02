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
		case 'jsonexample':
			$this->Page = new PageJSON('JSON Example', 'pages/jsonexample.php', 'test');
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
		case 'imgur':
			$this->Page = new PageJSON('imgur', 'pages/imgur.php');
			break;
		case 'twitter':
			$this->Page = new PageJSON('twitter', 'pages/twitter.php');
			break;
		default:
			$this->Page = new PageHTML('404', 'pages/status/404.php');
		}
		$this->Page->display();
	}
}