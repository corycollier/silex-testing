<?php

require_once __DIR__.'/../vendor/autoload.php';

use Silex\Provider\FormServiceProvider;
use Symfony\Component\Intl\ResourceBundle\Writer\TextBundleWriter;
use Symfony\Component\Intl\ResourceBundle\Compiler\BundleCompiler;

$app = new Silex\Application();
$dispatcher = new App\Dispatcher();
$dispatcher->configure($app);

$app->register(new Silex\Provider\DoctrineServiceProvider, [
	'db.options' => [
		'driver' => 'pdo_mysql',
		'url' => 'mysql://silex:silex@127.0.0.1/silex',
	]
]);


$app->register(new FormServiceProvider);

// $app['repository.image'] = $app->share(function($app) {
// 	return new App\Repository\ImageRepository($app['db']);
// });

$app['controllers']->convert('image', function($id) use ($app) {
	if ($id) {
		return $app['repository.image']->find($id);
	}
});

$app['debug'] = true;

$app->get('/image', 'App\Controller\ImageController::indexAction')->bind('images');
$app->get('/image/{image}', 'App\Controller\ImageController::viewAction')->bind('images');
$app->get('/images/create', 'App\Controller\Imagecontroller::createAction');

return $app;