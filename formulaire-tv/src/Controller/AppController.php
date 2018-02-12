<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
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
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\HttpFoundation\Session\Session;

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
			->add('email', EmailType::class, [
				'label_attr' => [
					'class' => 'required'
				],
				'required' => false,
			])
			->add('name', TextType::class, [
				'label' => 'Nom prénom ou nom de l\'entreprise',
				'label_attr' => [
					'class' => 'required'
				],
			])
			->add('logoFile', VichImageType::class, [
				'label' => 'Logo de l\'entreprise',
				'image_uri' => true,
				'imagine_pattern' => 'squared_thumbnail',
				'label_attr' => [
					'class' => 'required'
				],
			])
			->add('imageFile', VichImageType::class, [
				'label' => 'et/ou représentant',
				'image_uri' => true,
				'imagine_pattern' => 'squared_thumbnail',
				'label_attr' => [
					'class' => 'required'
				],
			])
			->add('bio', TextareaType::class, [
				'label' => 'Décrivez brièvement votre activité',
				'attr' => [
					'class' => 'textarea'
				],
				'label_attr' => [
					'class' => 'required'
				],
			])
			->add('url', UrlType::class, [
				'label' => 'Lien vers le site',
				'required' => false,
			])
			->add('facebook', UrlType::class, [
				'label' => 'Facebook',
				'required' => false,
			])
			->add('twitter', TextType::class, [
				'required' => false,
			])
			->add('instagram', TextType::class, [
				'required' => false,
			])
			->add('linkedin', UrlType::class, [
				'required' => false,
			])
			->add('submit', SubmitType::class, ['label' => 'Envoyer'])
			->getForm();

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			/** @var Member $member */
			$member = $form->getData();
			// Clean HTML tags ciming from past into tinymce
			$member->setBio(
				preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', strip_tags($member->getBio(), '<p><strong><b>'))
			);

			$em->persist($member);
			$em->flush();

			$session = new Session();
			$session->start();

			$session->set('id', $member->getId());

			return $this->redirectToRoute('valid');
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
		$session = new Session();
		if ($session->get('id')) {
			$id = $session->get('id');
			$member = $this->getDoctrine()->getRepository(Member::class)->find($id);
			if ($member) {
				return $this->render('valid.html.twig', [
					'member' => $member
				]);
			} else {
				throw $this->createNotFoundException('Aucun membre');
			}
		}
		throw $this->createNotFoundException('Aucun id');
	}

	/**
	 * @Route("/delete", name="delete")
	 * @return Response
	 */
	public function delete()
	{
		$session = new Session();
		if ($session->get('id')) {
			$id = $session->get('id');
			$member = $this->getDoctrine()->getRepository(Member::class)->find($id);
			$em = $this->getDoctrine()->getManager();

			$em->remove($member);
			$em->flush();

			return $this->redirectToRoute('home');
		}

		throw $this->createNotFoundException('Aucun id');
	}

	/**
	 * @Route("/dump", name="dump")
	 * @return JsonResponse
	 */
	public function dump()
	{
		throw $this->createNotFoundException('not available');

		$members = $this->getDoctrine()->getRepository(Member::class)->findAll();
		$encoders = [new JsonEncoder()];
		$normalizers = [new ObjectNormalizer()];

		$serializer = new Serializer($normalizers, $encoders);
		$json = $serializer->serialize($members, 'json');

		return new JsonResponse($json, 200, [], true);
	}

}
