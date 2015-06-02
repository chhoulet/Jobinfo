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
}