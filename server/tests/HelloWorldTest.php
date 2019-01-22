<?php
use PHPUnit\Framework\TestCase;

class HelloWorldTest extends TestCase
{
	private $pdo;

	public function setUp()
	{
		/* To Be Executed At First */
	}

	public function tearDown()
	{
		/* To Be Executed At .ast */
	}

	public function testHelloWorld()
	{
		$this->assertEquals('Hello World', 'Hello World');
		$Page = new Page("Hello", "lel");
	}
}