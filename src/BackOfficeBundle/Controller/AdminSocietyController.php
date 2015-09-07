<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeEmploiBundle\Entity\Society;
use FrontOfficeEmploiBundle\Form\SocietyType;
use Symfony\Component\HttpFoundation\Request;

class AdminSocietyController extends Controller
{
	# Liste des sociétés + onglet statistique:
	public function triSocietyAction()
	{		
		$em = $this -> getDoctrine()->getmanager();
		$triSociety = $em -> getRepository('FrontOfficeEmploiBundle:Society') -> triSociety();
		$societiesByNbResponses = $em -> getRepository('FrontOfficeEmploiBundle:Society') -> getSocietiesByNbResponses();

		return $this -> render('BackOfficeBundle:AdminSociety:triSociety.html.twig', 
			array('triSociety'             => $triSociety,
				  'societiesByNbResponses' => $societiesByNbResponses));
	}

	# Edition d'une society:
	public function editAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getmanager();
		$session = $request -> getSession();
		$society = $em -> getRepository('FrontOfficeEmploiBundle:Society') -> find($id);
		$formSociety = $this -> createForm(new SocietyType(), $society);

		$formSociety -> handleRequest($request);
		
		if($formSociety -> isValid())
		{
			$society -> setdateUpdated(new \datetime('now'));
			$em -> persist($society);
			$em -> flush();

			$session ->getFlashbag()->add('notice','Vos modifications sont bien enregistrées !');
			return $this -> redirect($this->generateUrl('back_office_adminSociety_list'));
		}

		return $this -> render('BackOfficeBundle:AdminSociety:edit.html.twig', 
			array('formSociety' => $formSociety ->createView()));
	}

	# Suppression d'une society :
	public function deleteSocietyAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$deletedSociety = $em -> getRepository('FrontOfficeEmploiBundle:Society') -> find($id);
		$em -> remove($deletedSociety);
		$em -> flush();

		$session -> getFlashbag()->add('succes','La société sélectionnée a bien été supprimée');
		return $this -> redirect($request -> headers -> get('referer'));
	}
}