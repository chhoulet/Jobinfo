<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeEmploiBundle\Entity\JobOffer;
use FrontOfficeEmploiBundle\Form\JobOfferType;
use Symfony\Component\HttpFoundation\Request;

class AdminJobOffersController extends Controller
{
	public function listJobOffersAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$showJobOffers = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer')->findAll();

		return $this ->render('BackOfficeBundle:AdminJobOffers:listJobOffers.html.twig', 
			array('showJobOffers' => $showJobOffers));
	}

	public function editJobOfferAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request->getSession();
		$editJobOffer = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer')->find($id);
		$formJobOffer = $this -> createForm(new JobOfferType(), $editJobOffer);

		$formJobOffer -> handleRequest($request);

		if($formJobOffer -> isValid())
		{
			$em -> persist($editJobOffer);
			$em -> flush();

			$session ->getFlashbag()->add('succes','Vos modifications ont été prises en compte !');
			return $this ->redirect($this->generateUrl('back_office_adminjobOffers_show'));
		}

		return $this -> render('BackOfficeBundle:AdminJobOffers:editJobOffer.html.twig', 
			array('formJobOffer' => $formJobOffer -> createView()));
	}

	public function deleteJobOfferAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session =$request -> getSession();
		$deleteJobOffer = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer')->find($id);
		$em -> remove($deleteJobOffer);
		$em -> flush();

		$session ->getFlashbag()->add('notice','L\'élément sélectionné a bien été supprimé !');
		return $this-> redirect($request -> headers -> get('referer'));
	}
	
	# Template de statistiques :
	public function statsJobOffersAction()
	{
		$em = $this -> getDoctrine()-> getManager();
		$nbJobOffersByPlace = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer') ->getNbJobOffersByPlace();
		$nbJobOffersBySociety = $em -> getRepository('FrontOfficeEmploiBundle:Society') ->getNbJobOffersBySociety();
		$nbJobOffersByJobSector = $em -> getRepository('FrontOfficeEmploiBundle:JobSector') ->getNbJobOffersByJobSector();
		$nbJobOffersWithMoreResponses = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer') ->getJobOffersWithMoreResponses();
		$placeByNbJobOffers	= $em -> getRepository('FrontOfficeEmploiBundle:Place') -> getPlaceByNbJobOffers();

		return $this -> render('BackOfficeBundle:AdminJobOffers:stats.html.twig', 
			array('nbJobOffersByPlace'          => $nbJobOffersByPlace,
				  'nbJobOffersBySociety'        => $nbJobOffersBySociety,
				  'nbJobOffersByJobSector'      => $nbJobOffersByJobSector,
				  'nbJobOffersWithMoreResponses'=> $nbJobOffersWithMoreResponses,
				  'placeByNbJobOffers'          => $placeByNbJobOffers));
	}
}