<?php

namespace FrontOfficeHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeHomepageBundle\Entity\Formation;
use Symfony\Component\HttpFoundation\Request;

class FormationController extends Controller
{
	public function listAction($formationType)
	{
		$em = $this -> getDoctrine()->getManager();
		$formation = $em -> getRepository('FrontOfficeHomepageBundle:Formation') -> getFormations($formationType);

		return $this -> render('FrontOfficeHomepageBundle:Formation:formation.html.twig', array('formation'=>$formation));
	}

	public function showOneAction($id)
	{
		$em = $this-> getDoctrine()->getManager();
		$showOne = $em -> getRepository('FrontOfficeHomepageBundle:Formation')->find($id);

		return $this -> render('FrontOfficeHomepageBundle:Formation:oneFormation.html.twig', array('oneFormation'=>$showOne));
	}

	public function inscriptionAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()-> getManager();
		$session = $request -> getSession();
		$formation = $em -> getRepository('FrontOfficeHomepageBundle:Formation')->find($id);
		$formation -> addInscrit($this -> getUser());
		$em -> flush();

		$session -> getFlashbag()->add('notice','Votre inscription est enregistrée !');
		return $this -> redirect($request -> headers -> get('referer'));
	}
}