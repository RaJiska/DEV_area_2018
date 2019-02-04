<?php
require_once('classes/Page.php');

class PageJSON extends Page
{
	public function display()
	{
		header('Content-Type: application/json');
		require_once($this->path);
	}
}