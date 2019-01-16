<?php
class Page
{
	public $title;
	public $path;

	public function __construct($title, $path)
	{
		$this->title = $title;
		$this->path = $path;
	}

	public function load()
	{
		require_once($this->path);
	}
}
