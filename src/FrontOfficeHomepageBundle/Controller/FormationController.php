<?php

namespace FrontOfficeHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeHomepageBundle\Entity\Formation;
use Symfony\Component\HttpFoundation\Request;

class FormationController extends Controller
{
	# Affichage des formations par type, selection du type en homepage:
	public function listAction($formationType)
	{
		$em = $this -> getDoctrine()->getManager();
		$formation = $em -> getRepository('FrontOfficeHomepageBundle:Formation') -> getFormations($formationType);

		return $this -> render('FrontOfficeHomepageBundle:Formation:formation.html.twig', array('formation'=>$formation));
	}

	# Détail d'une formation:
	public function showOneAction($id)
	{
		$em = $this-> getDoctrine()->getManager();
		$showOne = $em -> getRepository('FrontOfficeHomepageBundle:Formation')->find($id);

		return $this -> render('FrontOfficeHomepageBundle:Formation:oneFormation.html.twig', array('oneFormation'=>$showOne));
	}

	# Ajout  d'un inscrit dans la join-table user_formation:
	public function inscriptionAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()-> getManager();
		$session = $request -> getSession();
		$formation = $em -> getRepository('FrontOfficeHomepageBundle:Formation')->find($id);
		$formation -> addInscrit($this -> getUser());
		$em -> flush();

		# Message flash:
		$session -> getFlashbag()->add('notice','Votre inscription est enregistrée !');
		# Redirection sur la page d'où vient l'user:
		return $this -> redirect($request -> headers -> get('referer'));
	}

	# Desinscription d'un user d'une formation:
	public function desinscriptionFormationAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()-> getManager();
		$session = $request -> getSession();
		$formation = $em -> getRepository('FrontOfficeHomepageBundle:Formation')->find($id);	
		$formation -> removeInscrit($this -> getUser());
		$em -> flush();

		$session -> getFlashbag()->add('succes','Vous êtes désinscrit de cet évenement');
		return $this -> redirect($request -> headers -> get('referer'));
	}
}