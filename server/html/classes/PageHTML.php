<?php
require_once 'classes/Page.php';

class PageHTML extends Page
{
	public function display()
	{
		$headerTitle = (!empty($this->title)) ? $GLOBALS['config']['website'] . " - " . $this->title : $GLOBALS['config']['website'];
		echo("
			<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
			<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
			<head>
			<title>$headerTitle</title>
			</head>
			<body>
		");
		require_once($this->path);
		echo("
			</body>
			</html>
		");
	}
}