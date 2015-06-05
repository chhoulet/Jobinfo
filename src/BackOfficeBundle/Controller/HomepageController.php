<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
	public function homepageAction()
	{
		$em          = $this -> getDoctrine()->getManager();
		$nbCandidats = $em -> getRepository('FrontOfficeEmploiBundle:Candidat') -> nbCandidats();
		$nbJobOffers = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer') -> nbJobOffers();
		$nbSociety   = $em -> getRepository('FrontOfficeEmploiBundle:Society') -> nbSociety();
		$nbComments  = $em -> getRepository('FrontOfficeHomepageBundle:Comment') -> nbComments();
		$getFormationType = $em -> getRepository('FrontOfficeHomepageBundle:Formation') -> getFormationType();
		$getNbFormationByType = $em -> getRepository('FrontOfficeHomepageBundle:Formation') -> getNbFormationByType();

		return $this -> render('BackOfficeBundle:Homepage:homepage.html.twig', 
			array('nbCandidats' => $nbCandidats,
				  'nbJobOffers' => $nbJobOffers,
				  'nbSociety'   => $nbSociety,
				  'nbComments'  => $nbComments,
				  'getFormationType' => $getFormationType,
				  'getNbFormationByType' => $getNbFormationByType));
	}
}
