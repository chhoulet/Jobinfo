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
}
