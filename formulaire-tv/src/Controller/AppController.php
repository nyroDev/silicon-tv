<?php
namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Member;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class AppController extends Controller
{
	
	/**
	 * @Route("/", name="home")
	 * @param Request $request
	 * @return Response
	 */
	public function home(Request $request)
	{
		$member = new Member();
		
		$form = $this->createFormBuilder($member)
            ->add('email', EmailType::class)
            ->add('name', TextType::class)
            ->add('imageFile', VichFileType::class)
            ->add('bio', TextareaType::class)
            ->add('url', UrlType::class)
            ->add('facebook', UrlType::class)
            ->add('twitter', TextType::class)
            ->add('instagram', TextType::class)
            ->add('linkedin', UrlType::class)
            ->add('submit', SubmitType::class, ['label' => 'Envoyer'])
			->getForm();
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$member = $form->getData();
			
			$em->persist($member);
			$em->flush();
			
			$this->redirectToRoute("valid");
		}
		
		return $this->render('home.html.twig', [
			'form' => $form->createView()
		]);
	}
	
	/**
	 * @Route("/valid", name="valid")
	 * @return Response
	 */
	public function valid()
	{
		return $this->render('valid.html.twig');
	}
	
	/**
	 * @Route("/dump", name="dump")
	 * @return JsonResponse
	 */
	public function dump()
	{
		$members = $this->getDoctrine()->getRepository(Member::class)->findAll();
		$encoders = [new JsonEncoder()];
		$normalizers = [new ObjectNormalizer()];
		
		$serializer = new Serializer($normalizers, $encoders);
		$json = $serializer->serialize($members, 'json');
		
		return new JsonResponse($json, 200, [], true);
	}
	
}