<?php

namespace FrontOfficeEmploiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeEmploiBundle\Entity\JobOffer;
use FrontOfficeEmploiBundle\Form\JobOfferType;
use Symfony\Component\HttpFoundation\Request;

class JobOfferController extends Controller
{
	public function showOneJobOfferAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$showOneJobOffer = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer')->find($id);

		return $this -> render('FrontOfficeEmploiBundle:JobOffer:showOneJobOffer.html.twig', array('showOneJobOffer'=> $showOneJobOffer));
	}

	public function responseJobOfferAction(Request $request, $id, $id_LM, $id_cuvitae, $id_candidat)
	{
		$em = $this -> getDoctrine()->getManager();
		$responseJobOffer = new ResponseJobOffer();
		$motivationLetter = $em -> getRepository('FrontOfficeEmploiBundle:MotivationLetter')->find($id_LM);
		$jobOffer = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer')->find($id);
		$cuvitae = $em -> getRepository('FrontOfficeEmploiBundle:Cuvitae')->find($id_cuvitae);
		$candidat =  $em -> getRepository('FrontOfficeEmploiBundle:Candidat')->find($id_candidat);

		$formResponseJobOffer = $this -> createForm(new ResponseJobOfferType(), $responseJobOffer);

		$formResponseJobOffer -> handleRequest($request);

		if($formResponseJobOffer -> isValid())
		{
			$responseJobOffer -> addCuvitae($cuvitae);
			$responseJobOffer -> addMotivationLetter($motivationLetter);
			$responseJobOffer -> setDateCreated(new \DateTime('now'));
			$responseJobOffer -> setJobOffer($jobOffer);
			$responseJobOffer -> setCandidat($candidat);
			$em ->persist($responseJobOffer);
			$em -> flush();

			return $this -> redirect($this -> generateUrl('front_office_emploi_jobOffer_showOne'));
		}

		return $this ->render('FrontOfficeEmploiBundle:JobOffer:responseJobOffer.html.twig', 
			array('formResponseJobOffer'=>$formResponseJobOffer->createView()));
	}
}
