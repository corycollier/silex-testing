<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{
	public function indexAction(Request $request, Application $app) 
	{
		return $app->json([
			'message' => 'hello world',
		]);
	}
}