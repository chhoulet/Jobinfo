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

		return $this -> render('FrontOfficeHomepageBundle:Formation:formation.html.twig',
			array('formation'=>$formation));
	}

	# Détail d'une formation:
	public function showOneAction($id)
	{
		$em = $this-> getDoctrine()->getManager();

		# Recuperation de la formation selectionnée:
		$showOne = $em -> getRepository('FrontOfficeHomepageBundle:Formation')->find($id);

		# Recuperation de l'user connecte ainsi que de la formation selectionnee:
		$formationByInscrit = $em -> getRepository('FrontOfficeHomepageBundle:Formation')
			->getFormationByInscrit($showOne, $this->getUser());

		return $this -> render('FrontOfficeHomepageBundle:Formation:oneFormation.html.twig', 
			array('oneFormation' => $showOne,
				  'formationByInscrit' => $formationByInscrit));
	}

	# Ajout  d'un inscrit dans la join-table user_formation:
	public function inscriptionAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()-> getManager();
		$session = $request -> getSession();

		# Recuperation de la formation selectionnée:
		$formation = $em -> getRepository('FrontOfficeHomepageBundle:Formation')->find($id);		
		$formation -> addInscrit($this -> getUser());
		$em -> flush();

		# Message flash + redirection sur la meme page:
		$session -> getFlashbag()->add('notice','Votre inscription est enregistrée !');
		return $this -> render($this -> redirect($request -> headers -> get('referer')));			
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