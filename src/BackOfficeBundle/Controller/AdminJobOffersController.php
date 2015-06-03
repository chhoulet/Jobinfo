<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeEmploiBundle\Entity\JobOffer;
use FrontOfficeEmploiBundle\Form\JobOfferType;
use Symfony\Component\HttpFoundation\Request;

class AdminJobOffersController extends Controller
{
	public function showJobOffersAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$showJobOffers = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer')->findAll();

		return $this ->render('BackOfficeBundle:AdminJobOffers:showJobOffers.html.twig', 
			array('showJobOffers' => $showJobOffers));
	}

	public function editJobOfferAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$editJobOffer = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer')->find($id);
		$formJobOffer = $this -> createForm(new JobOfferType(), $editJobOffer);

		$formJobOffer -> handleRequest($request);

		if($formJobOffer -> isValid())
		{
			$em -> persist($editJobOffer);
			$em -> flush();
			return $this ->redirect($this->generateUrl('back_office_adminjobOffers_show'));
		}

		return $this -> render('BackOfficeBundle:AdminJobOffers:editJobOffer.html.twig', 
			array('formJobOffer' => $formJobOffer -> createView()));
	}

	public function deleteJobOfferAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$deleteJobOffer = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer')->find($id);
		$em -> remove($deleteJobOffer);
		$em -> flush();

		return $this-> redirect($this->generateUrl('back_office_adminjobOffers_show'));
	}
}