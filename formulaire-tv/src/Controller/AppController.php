<?php
namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Member;
use Vich\UploaderBundle\Form\Type\VichFileType;

class AppController extends Controller
{
	
	/**
	 * @Route("/")
	 */
	public function home()
	{
		$member = new Member();
		$test = $this->getDoctrine()->getRepository(Member::class)->findAll();
		var_dump($test);
		
		$form = $this->createFormBuilder($member)
            ->add('email', EmailType::class)
            ->add('name', TextType::class)
            ->add('imageFile', VichFileType::class)
            ->add('bio', TextType::class)
            ->add('url', UrlType::class)
            ->add('facebook', UrlType::class)
            ->add('twitter', TextType::class)
            ->add('instagram', TextType::class)
            ->add('linkedin', UrlType::class)
            ->add('submit', SubmitType::class, ['label' => 'Envoyer'])
			->getForm();
			
		return $this->render('home.html.twig', [
			'form' => $form->createView(),
			'test' => $test
		]);
	}
	
}