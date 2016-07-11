<?php

namespace App\Tests\Controller;

use PHPUnit\Framework\TestCase;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\IndexController as IndexController;

class IndexControllerTest extends TestCase
{
	public function testIndexAction()
	{
		$sut = new IndexController;

		$app = $this->getMockBuilder('\Silex\Application')
			->disableOriginalConstructor()
			->setMethods([])
			->getMock();

		$request = $this->getMockBuilder('\Symfony\Component\HttpFoundation\Request')
			->disableOriginalConstructor()
			->setMethods([])
			->getMock();

		$result = $sut->indexAction($request, $app);

		$this->assertEquals('Hello World', $result);
	}
}