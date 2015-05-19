<?php

namespace FrontOfficeHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeHomepageBundle\Entity\Formation;

class FormationController extends Controller
{
	public function listAction($formationType)
	{
		$em = $this -> getDoctrine()->getManager();
		$formation = $em -> getRepository('FrontOfficeHomepageBundle:Formation') -> getFormations($formationType);

		return $this -> render('FrontOfficeHomepageBundle:Formation:formation.html.twig', array('formation'=>$formation));
	}

	public function oneFormationAction($id)
	{
		$em = $this-> getDoctrine()->getManager();
		$oneFormation = $em -> getRepository('FrontOfficeHomepageBundle:Formation')->find($id);

		return $this -> render('FrontOfficeHomepageBundle:Formation:oneFormation.html.twig', array('oneFormation'=>$oneFormation));
	}
}