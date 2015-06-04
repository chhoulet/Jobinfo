<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeEmploiBundle\Entity\JobSector;
use FrontOfficeEmploiBundle\Form\JobSectorType;
use Symfony\Component\HttpFoundation\Request;

class AdminJobSectorController extends Controller
{
	public function listAction()
	{
		$em = $this -> getDoctrine()-> getManager();
		$listJobSector = $em -> getRepository('FrontOfficeEmploiBundle:JobSector')->findAll();

		return $this -> render('BackOfficeBundle:AdminJobSector:list.html.twig', array('listJobSector'=>$listJobSector));
	}
}