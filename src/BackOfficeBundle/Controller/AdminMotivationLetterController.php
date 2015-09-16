<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminMotivationLetterController extends Controller
{
	public function listMotivationLetterAction()
	{
		$em = $this -> getDoctrine()-> getManager();
		$listMotivationLetter = $em -> getRepository('FrontOfficeEmploiBundle:MotivationLetter')-> findAll();

		return $this -> render('BackOfficeBundle:AdminMotivationLetter:listMotivationLetter.html.twig', 
			array('listMotivationLetter'=>$listMotivationLetter));
	}
}