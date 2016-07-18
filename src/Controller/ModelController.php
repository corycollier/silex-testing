<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

abstract class ModelController
{
	protected $resource;
	protected $service;

	public function __construct()
	{
		$resource = ucwords($this->resource);
		$service = "App\\Service\\{$resource}";
		$this->service = new $service;
	}

	public function indexAction(Request $request, Application $app) 
	{
		try {
			return $app->json([
				'results' => $this->service->all($request->attributes->all()),
				'message' => 'hello world of indexing',
			]);
		} catch (Exception $exception) {
			var_dump($exception);
			die;			
		}
	}

	public function createAction(Request $request, Application $app)
	{
		try {
			return $app->json([
				'results' => $this->service->create($request->attributes->all()),
				'message' => 'hello world of creating',
			]);
		} catch (Exception $exception) {
			var_dump($exception);
			die;			
		}
	}

	public function readAction(Request $request, Application $app)
	{
		try {
			return $app->json([
				'results' => $this->service->read($request->attributes->all()),
				'message' => 'hello world of reading',
			]);
		} catch (Exception $exception) {
			var_dump($exception);
			die;			
		}
	}

	public function updateAction(Request $request, Application $app) 
	{
		try {
			return $app->json([
				'results' => $this->service->update($request->attributes->all()),
				'message' => 'hello world of updating',
			]);
		} catch (Exception $exception) {
			var_dump($exception);
			die;			
		}
	}

	public function deleteAction(Request $request, Application $app)
	{
		try {
			return $app->json([
				'results' => $this->service->delete($request->attributes->all()),
				'message' => 'hello world of deleting'
			]);
		} catch (Exception $exception) {
			var_dump($exception);
			die;			
		}
	}
}