<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
	public function homepageAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$nbCandidats = $em -> getRepository('FrontOfficeEmploiBundle:Candidat') -> nbCandidats();
		$nbJobOffers = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer') -> nbJobOffers();

		return $this -> render('BackOfficeBundle:Homepage:homepage.html.twig', 
			array('nbCandidats' => $nbCandidats,
				  'nbJobOffers' => $nbJobOffers));
	}
}
