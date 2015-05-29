<?php

namespace FrontOfficeEmploiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeEmploiBundle\Entity\JobOffer;
use FrontOfficeEmploiBundle\Form\JobOfferType;
use Symfony\Component\HttpFoundation\Request;
use FrontOfficeEmploiBundle\Entity\ResponseJobOffer;
use FrontOfficeEmploiBundle\Form\ResponseJobOfferType;
use FrontOfficeEmploiBundle\Entity\Cuvitae;
use FrontOfficeEmploiBundle\Entity\Candidat;
use FrontOfficeEmploiBundle\Entity\MotivationLetter;

class JobOfferController extends Controller
{
	public function showOneJobOfferAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$showOneJobOffer = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer')->find($id);

		return $this -> render('FrontOfficeEmploiBundle:JobOffer:showOneJobOffer.html.twig', array('showOneJobOffer'=> $showOneJobOffer));
	}

	public function responseJobOfferAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$responseJobOffer = new ResponseJobOffer();
		$jobOffer = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer')->find($id);

		$formResponseJobOffer = $this -> createForm(new ResponseJobOfferType(), $responseJobOffer);

		$formResponseJobOffer -> handleRequest($request);

		if($formResponseJobOffer -> isValid())
		{
			/*Les id du CV et de la LM sont recuperees dans le formulaire, donc il faut qu'on ait teste d'abord sa valididté avant de pouvoir en exploiter les données.*/
			/*Ces deux lignes ci-dessous sont superflues, les informations sont récupérées directement via le formulaire*/
			//$motivationLetter = $em -> getRepository('FrontOfficeEmploiBundle:MotivationLetter')->find($id_LM);
			//$cuvitae = $em -> getRepository('FrontOfficeEmploiBundle:Cuvitae')->find($id_cuvitae);
			$responseJobOffer -> setDateCreated(new \DateTime('now'));
			$responseJobOffer -> setJobOffer($jobOffer);
			$responseJobOffer -> setCandidat($this->getUser());

			$em ->persist($responseJobOffer);
			$em -> flush();

			return $this -> redirect($this -> generateUrl('front_office_emploi_jobOffer_showOne', array('id'=>$id)));
		}

		return $this ->render('FrontOfficeEmploiBundle:JobOffer:responseJobOffer.html.twig', 
			array('formResponseJobOffer'=>$formResponseJobOffer->createView()));
	}

	public function getResponseJobOfferAction()
	{
		$em = $this -> getDoctrine()-> getManager();
		$jobOffer = $em -> getRepository('FrontOfficeEmploiBundle:ResponseJobOffer')->getJobOfferResponses($this->getUser());
		
		return $this -> render('FrontOfficeEmploiBundle:JobOffer:getResponseJobOffer.html.twig', 
			array('getResponseJobOffer' => $jobOffer));
	}
}
