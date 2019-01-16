<?php
require_once('classes/Page.php');

class PageManager
{
	private $Page;

	public function display()
	{
		require_once($this->Page->path);
		$headerTitle = (!empty($this->Page::TITLE)) ? $config['website'] . " - " . $this->Page::TITLE : $config['website'];
		echo("
			<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
			<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
			<head>
			<title>$headerTitle</title>
			</head>
			<body>
		");
		$this->Page->load();
		echo("
			</body>
			</html>
		");
	}

	public function retrieve($page)
	{
		switch ($page)
		{
		case null:
			$this->Page = new Page('', 'pages/home.php');
			break;
		default:
			$this->Page = new Page('404', 'pages/status/404.php');
		}
	}
}