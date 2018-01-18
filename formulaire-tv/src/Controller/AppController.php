<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
	
	/**
	 * @Route("/")
	 */
	public function home()
	{
		//$form->
		return $this->render('lucky/number.html.twig', [
			//'form' => $form->createView(),
		]);
	}
}