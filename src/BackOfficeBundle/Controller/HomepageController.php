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
		$getNbFormationByType = $em -> getRepository('FrontOfficeHomepageBundle:Formation') -> getNbFormationByType();
		$nbFormations = $em -> getRepository('FrontOfficeHomepageBundle:Formation') -> nbFormations();
		$nbForums    = $em -> getREpository('FrontOfficeHomepageBundle:Forum') -> nbForums();
		$nbEta     = $em -> getRepository('FrontOfficeHomepageBundle:Etablissement') -> nbEtablissements();

		return $this -> render('BackOfficeBundle:Homepage:homepage.html.twig', 
			array('nbCandidats' => $nbCandidats,
				  'nbJobOffers' => $nbJobOffers,
				  'nbSociety'   => $nbSociety,
				  'nbComments'  => $nbComments,
				  'nbFormations'=> $nbFormations,
				  'nbForums'    => $nbForums,
				  'nbEta'       => $nbEta
				  /*'getNbFormationByType' => $getNbFormationByType*/));
	}
}
