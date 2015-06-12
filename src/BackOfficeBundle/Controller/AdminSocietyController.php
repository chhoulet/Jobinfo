<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminSocietyController extends Controller
{
	public function triSocietyAction()
	{
		$em = $this -> getDoctrine()->getmanager();
		$triSociety = $em -> getRepository('FrontOfficeEmploiBundle:Society') -> triSociety();

		return $this -> render('BackOfficeBundle:AdminSociety:triSociety.html.twig', 
			array('triSociety' => $triSociety));
	}
}