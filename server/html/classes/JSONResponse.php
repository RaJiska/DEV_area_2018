<?php

class JSONResponse
{
	private $status;
	private $msg;
	private $data = null;

	public function __construct($data = "")
	{
		$this->data = $data;
	}

	public function __toString()
	{
		return [$this->data];
	}
}