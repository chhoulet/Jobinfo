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
		$em = $this -> getDoctrine()-> getManager();
		$message = new Message();
		$form = $this -> createForm(new MessageType(), $message);

		$form -> handleRequest($request);

		if($form -> isValid())
		{
			$message -> setDateCreated(new \datetime('now'));
			$message -> setReadMessage(false);
			$em -> persist($message);
			$em ->flush();			

			return $this -> redirect($this -> generateUrl('front_office_homepage_homepage'));
		}

		return $this -> render('FrontOfficeHomepageBundle:Static:contact.html.twig', 
			array('form'=>$form->createView()));
	}
}