<?php
require_once 'config/config.php';

class Page
{
	public $title;
	public $path;
	protected $func;

	public function __construct($title, $path, $func = "")
	{
		$this->title = $title;
		$this->path = $path;
		$this->func = $func;
	}
}