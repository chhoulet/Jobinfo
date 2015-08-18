<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeHomepageBundle\Entity\Etablissement;
use FrontOfficeHomepageBundle\Form\EtablissementType;
use Symfony\Component\HttpFoundation\Request;

class AdminEtablissementController extends Controller
{
	public function listAction()
	{
		$em = $this -> getDoctrine()-> getmanager();
		$list = $em -> getRepository('FrontOfficeHomepageBundle:Etablissement') -> findAll();

		return $this -> render('BackOfficeBundle:AdminEtablissement:list.html.twig', array('list'=>$list));
	}

	public function newAction(Request $request)
	{
		$em = $this -> getDoctrine()->getManager();
		$newEta = new Etablissement();
		$session = $request -> getSession();
		$form = $this -> createForm(new EtablissementType(), $newEta);

		$form -> handleRequest($request);

		if($form -> isValid())
		{
			$newEta ->setDateCreated(new \DateTime('now'));
			$em -> persist($newEta);
			$em ->flush();

			$session ->getFlashbag()->add('newet','Votre établissement est bien créé dans la base !');
			return $this->redirect($this->generateUrl('back_office_adminEtablissement_list'));
		}

		return $this -> render('BackOfficeBundle:AdminEtablissement:new.html.twig', array('form'=> $form->createView()));
	}

	public function triAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$tri = $em -> getRepository('FrontOfficeHomepageBundle:Etablissement') -> triEtablissements();

		return $this -> render('BackOfficeBundle:AdminEtablissement:tri.html.twig', array('tri'=>$tri));
	}

	public function deleteAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$deleteEta = $em -> getRepository('FrontOfficeHomepageBundle:Etablissement') -> find($id);
		$em -> remove($deleteEta);
		$em -> flush();

		$session ->getFlashbag()->add('succes','L\'etablissement selectionné a bien été supprimé !');
		return $this -> redirect($this->generateUrl('back_office_adminEtablissement_list'));
	}
}