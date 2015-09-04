<?php

namespace FrontOfficeEmploiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfilController extends Controller
{	
	# Acces a son espace personnel via une requete DQL selectionnant le profil Candidat/Society en fonction de l'id de l'user logué:
	public function myProfilAction($user = null)
	{		
		$em = $this -> getDoctrine()->getManager();
		$NbJobOffersByUser = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer')->getNbJobOffersByUser($this ->getUser());		
		$myProfil = $em -> getRepository('FrontOfficeEmploiBundle:Candidat')->getCandidatByUser($this -> getUser());
		$myProfilSociety = $em -> getRepository('FrontOfficeEmploiBundle:Society')->getSocietyByUser($this -> getUser());

		return $this -> render('FrontOfficeEmploiBundle:Profil:myProfil.html.twig', 
			array('nbJobOffersByUser'    => $NbJobOffersByUser,				
				  'candidat'             => $myProfil,
				  'oneSociety'           => $myProfilSociety));
	}		

	public function nbJobOfferAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$nbJobOffer = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer') ->getNbJobOffersBySociety($id);
		$nbAvgJobOffer = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer') ->getAverageNbResponseJobOfferByJobOffer($id);
		$nbActiveJobOffersBySociety = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer') ->getNbActiveJobOffersBySociety($id);

		return $this -> render('FrontOfficeEmploiBundle:Profil:stats.html.twig',
			array('nbJobOffer'                => $nbJobOffer,
				  'nbAvgJobOffer'             => $nbAvgJobOffer,
				  'nbActiveJobOffersBySociety'=> $nbActiveJobOffersBySociety));
	}

	public function listMyJobOffersAction()
	{
		return $this -> render('FrontOfficeEmploiBundle:Profil:listMyJobOffers.html.twig');
	}
}