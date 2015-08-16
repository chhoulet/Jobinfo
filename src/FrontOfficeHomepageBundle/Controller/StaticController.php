<?php

namespace FrontOfficeHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeHomepageBundle\Entity\Message;
use FrontOfficeHomepageBundle\Form\MessageType;
use Symfony\Component\HttpFoundation\Request;

class StaticController extends Controller
{
	public function mentionsAction()
	{
		return $this-> render('FrontOfficeHomepageBundle:Static:mentions.html.twig');
	}

	public function conditionsAction()
	{
		return $this-> render('FrontOfficeHomepageBundle:Static:conditions.html.twig');
	}

	public function contactAction(Request $request)
	{
		# Création et enregistrement d'un message en BDD:
		$em = $this -> getDoctrine()-> getManager();
		$message = new Message();
		$session = $request -> getSession();
		$form = $this -> createForm(new MessageType(), $message);

		$form -> handleRequest($request);

		if($form -> isValid())
		{
			$message -> setDateCreated(new \datetime('now'));
			$message -> setReadMessage(false);
			$em -> persist($message);
			$em ->flush();			
			
			$session -> getFlashbag() -> add('contact','Votre message a été envoyé !');
			return $this -> redirect($this -> generateUrl('front_office_homepage_homepage'));
		}

		return $this -> render('FrontOfficeHomepageBundle:Static:contact.html.twig', 
			array('form'=>$form->createView()));
	}
}