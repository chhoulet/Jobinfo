<?php

namespace FrontOfficeEmploiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeEmploiBundle\Entity\Society;
use FrontOfficeEmploiBundle\Entity\JobOffer;
use FrontOfficeEmploiBundle\Form\SocietyType;
use FrontOfficeEmploiBundle\Form\JobOfferType;
use Symfony\Component\HttpFoundation\Request;


class EmployerController extends Controller
{
	public function createSocietyAction(Request $request)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$society = new Society();
		$formSociety = $this -> createForm(new SocietyType(), $society);

		$formSociety -> handleRequest($request);

		if($formSociety -> isValid())
		{
			$society -> setDateCreated(new \DateTime('now'));			
			$em -> persist($society);
			$em -> flush();

			$session ->getFlashbag()-> add('creasoc','Votre société est bien enregistrée dans la base !');
			return $this -> redirect($this -> generateUrl('front_office_homepage_homepage'));
		}

		return $this -> render('FrontOfficeEmploiBundle:Employer:createSociety.html.twig', 
			array('formSociety'=>$formSociety->createView()));
	}

	public function createJobOfferAction(Request $request)
	{
		$em = $this -> getDoctrine()->getManager();
		$jobOffer = new JobOffer();
		$session = $request -> getSession();
		$formJobOffer = $this -> createForm(new JobOfferType(), $jobOffer);

		$formJobOffer -> handleRequest($request);

		if($formJobOffer -> isValid())
		{
			$jobOffer -> setDateCreated(new \DateTime('now'));
			/*$jobOffer -> setSociety($this -> getUser()->getSociety());*/
			// $jobOffer -> setUser($this -> getUser());
			$em -> persist($jobOffer);
			$em -> flush();

			$session ->getFlashbag()->add('creation','Votre offre d\'emploi est bien publiée !');
			return $this -> redirect($this -> generateUrl('front_office_homepage_homepage'));
		}

		return $this -> render('FrontOfficeEmploiBundle:Employer:createJobOffer.html.twig', 
			array('formJobOffer'=>$formJobOffer->createView()));
	}
}