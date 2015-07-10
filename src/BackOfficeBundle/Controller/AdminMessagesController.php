<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeHomepageBundle\Entity\Message;
use Symfony\Component\HttpFoundation\Request;

class AdminMessagesController extends Controller
{
	public function listAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$messages = $em -> getRepository('FrontOfficeHomepageBundle:Message')->getMessages();

		return $this -> render('BackOfficeBundle:AdminMessage:list.html.twig', array('messages'=>$messages));
	}
}
