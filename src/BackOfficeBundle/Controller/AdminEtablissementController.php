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
		$form = $this -> createForm(new EtablissementType(), $newEta);

		$form -> handleRequest($request);

		if($form -> isValid())
		{
			$newEta ->setDateCreated(new \DateTime('now'));
			$em -> persist($newEta);
			$em ->flush();

			return $this->redirect($this->generateUrl('back_office_adminEtablissement_list'));
		}

		return $this -> render('BackOfficeBundle:AdminEtablissement:new.html.twig', array('form'=> $form->createView()));
	}
}