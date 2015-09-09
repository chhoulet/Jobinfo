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
	# Function selection une jobOffer:
	public function showOneJobOfferAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$showOneJobOffer = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer')->find($id);

		return $this -> render('FrontOfficeEmploiBundle:JobOffer:showOneJobOffer.html.twig', array('showOneJobOffer'=> $showOneJobOffer));
	}

	#  Selection d'une jobOffer par un candidat, attribution de l'id du user a la join table users_joboffers. 
	# La vue relationnelle entre User et Candidat assure la liaison dans l'espace personnel.
	public function selectAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$jobOffers = $this -> getUser()->getJobOffers();
		$selectedJobOffer = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer') -> find($id);	

		array_map(function($object) { return $object->getId(); }, $jobOffers);

		if(in_array(($selectedJobOffer), $id_jobOffers))
		{
			throw new \Exception('Vous avez déjà selectionné cette offre !');
			return $this -> redirect($request -> headers -> get('referer'));
		}

		$selectedJobOffer -> setDateSelected(new \DateTime('now'));
		$selectedJobOffer -> addUser($this -> getUser());
		$em -> flush();		
						
		$session -> getFlashbag()-> add('select','L\'offre sélectionnée se trouve maintenant dans votre espace personnel !');
		return $this -> redirect($request -> headers -> get('referer'));
	}

	# Function de reponse a une jobOffer par un candidat:
	public function responseJobOfferAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
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
			$responseJobOffer -> setUser($this->getUser());

			$session -> getFlashbag()-> add('notice','Votre candidature a bien été envoyée !');
			$em ->persist($responseJobOffer);
			$em -> flush();

			return $this -> redirect($this -> generateUrl('front_office_emploi_jobOffer_showOne', array('id'=>$id)));
		}
		
		return $this ->render('FrontOfficeEmploiBundle:JobOffer:responseJobOffer.html.twig', 
			array('formResponseJobOffer'=>$formResponseJobOffer->createView()));
	}
}
