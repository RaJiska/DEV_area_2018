<?php
require_once ('classes/PageHTML.php');
require_once ('classes/PageJSON.php');

class PageManager
{
	private $Page;

	public function retrieve($page)
	{
		switch ($page)
		{
		case null:
			$this->Page = new PageHTML('', 'pages/home.php');
			break;
		case 'jsonexample':
			$this->Page = new PageJSON('JSON Example', 'pages/jsonexample.php');
			break;
		case 'about':
			$this->Page = new PageJSON('About', 'pages/about.php');
			break;
		default:
			$this->Page = new PageHTML('404', 'pages/status/404.php');
		}
		$this->Page->display();
	}
}