<?php
require_once 'classes/pages/Page.php';

class PageJSON extends Page
{
	public function display()
	{
		header('Content-Type: application/json');
		require_once($this->path);
		if ($this->func === null)
			return;
		if (function_exists($this->func . $_SERVER['REQUEST_METHOD']))
			($this->func . $_SERVER['REQUEST_METHOD'])();
		else
			echo $GLOBALS['config']['json']['error']['invalid_method'];
	}
}