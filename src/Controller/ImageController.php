<?php
namespace App\Controller;

use App\Entity\Image as Image;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class ImageController extends ModelController
{
	protected $resource = 'image';

	public function createAction(Request $request, Application $app)
	{
		try {
			$image = new Image;
			$form = $app['form.factory']->create(new ImageType, $image);
			if ($request->isMethod('POST')) {
				$form->bind($request);
				if ($form->isValid()) {
					$app['repository.image']->save($image);

				}
			}

			return $app['twig']->render('form.html.twig', [
				'form' => $form->createView(),
				'title' => 'Add New Image',
			]);

		} catch (Exception $exception) {
			var_dump($exception);
			die;			
		}
	}
}