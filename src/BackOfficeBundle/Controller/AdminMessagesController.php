<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminMessagesController extends Controller
{
	public function listAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$messages = $em -> getRepository('FrontOfficeHomepageBundle:Message')->getMessages();

		return $this -> render('BackOfficeBundle:AdminMessage:list.html.twig', array('messages'=>$messages));
	}
}