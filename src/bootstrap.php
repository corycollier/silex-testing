<?php
// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request as Request;
use Symfony\Component\HttpFoundation\Response as Response;

$app = new Silex\Application();

$app->get('/', 'App\\Controller\\IndexController::indexAction');
$app->error(function(\Exception $exception, Request $request, $code) use ($app) {
	return $app->json([
		'message' => 'Strange things are afoot at the Circle K, Ted'
	]);
});

$app['debug'] = true;

return $app;