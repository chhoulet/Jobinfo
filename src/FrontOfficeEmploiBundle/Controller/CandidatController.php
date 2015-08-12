<?php

namespace FrontOfficeEmploiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeEmploiBundle\Entity\Cuvitae;
use FrontOfficeEmploiBundle\Entity\Candidat;
use FrontOfficeEmploiBundle\Entity\ResponseJobOffer;
use FrontOfficeEmploiBundle\Entity\MotivationLetter;
use FrontOfficeEmploiBundle\Form\CuvitaeType;
use FrontOfficeEmploiBundle\Form\MotivationLetterType;
use FrontOfficeEmploiBundle\Form\ResponseJobOfferType;
use Symfony\Component\HttpFoundation\Request;

class CandidatController extends Controller
{
	public function createCVAction(Request $request)
	{
		$em = $this -> getDoctrine()-> getManager();
		$session = $request -> getSession();
		$cv = new Cuvitae();
		$formCv = $this -> createForm(new CuvitaeType(), $cv);

		$formCv -> handleRequest($request);

		if($formCv -> isValid())
		{
			$cv -> setUser($this->getUser());
			$em -> persist($cv);
			$em -> flush();

			$session -> getFlashbag()-> add('notice','Votre CV est bien ajouté dans la base !');
			return $this -> redirect($this -> generateUrl('front_office_homepage_homepage'));
		}

		return $this -> render('FrontOfficeEmploiBundle:Candidat:createCV.html.twig', array('formCV' => $formCv -> createView()));
	}

	public function createLMAction(Request $request)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request ->getSession();
		$lm = new MotivationLetter();
		$formLm = $this -> createForm(new MotivationLetterType(), $lm);

		$formLm -> handleRequest($request);

		if($formLm -> isValid())
		 {		 	
		 	$lm -> setDateCreated(new \DateTime('now'));	
		 	$lm -> setUser($this -> getUser());
		 	$em -> persist($lm);
		 	$em -> flush();

		 	$session -> getFlashbag()-> add('succes','Votre lettre de motivation est bien enregistrée !');
		 	return $this -> redirect($this -> generateUrl('front_office_homepage_homepage'));
		 }

		return $this -> render('FrontOfficeEmploiBundle:Candidat:createLM.html.twig', array('formLm'=> $formLm -> createView())) ;
	}

	public function showMyCvAction()
	{
		return $this ->render('FrontOfficeEmploiBundle:Candidat:showMyCv.html.twig');
	}

	public function showMyLmAction()
	{		
		return $this -> render('FrontOfficeEmploiBundle:Candidat:showMyLm.html.twig');
	}

	public function monProfilAction()
	{
		return $this -> render('FrontOfficeEmploiBundle:Candidat:monProfil.html.twig');
	}

	public function showMyJobOffersAction()
	{
		return $this -> render('FrontOfficeEmploiBundle:Candidat:showMyJobOffers.html.twig');
	}
}