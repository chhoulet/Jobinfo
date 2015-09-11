<?php

namespace FrontOfficeEmploiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfilController extends Controller
{	
	# Acces a son espace personnel via une requete DQL selectionnant le profil Candidat/Society en fonction de l'id de l'user logué:
	public function myProfilAction($user = null)
	{		
		$em = $this -> getDoctrine()->getManager();
		$nbJobOffersByUser = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer')->getNbJobOffersByUser($this ->getUser());				
		$type = $this -> getUser() ->getType();

		if ($type == 'candidat'){
			$myProfil = $em -> getRepository('FrontOfficeEmploiBundle:Candidat')->getCandidatByUser($this -> getUser());			

			return $this -> render('FrontOfficeEmploiBundle:Profil:myProfil.html.twig', 
			array('nbJobOffersByUser'     => $nbJobOffersByUser,				  			
				  'candidat'              => $myProfil));
		}
		else{
			$myProfilSociety = $em -> getRepository('FrontOfficeEmploiBundle:Society')->getSocietyByUser($this -> getUser());

			return $this -> render('FrontOfficeEmploiBundle:Profil:myProfil.html.twig', 
			array('oneSociety'=> $myProfilSociety));
		}		
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

	public function myResponseOneJobOfferAction($id)
	{
		$em = $this -> getDoctrine()->getManager();		
	
			$jobOffer = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer')->find($id);
			$jobOfferResponseByUser = $em -> getRepository('FrontOfficeEmploiBundle:ResponseJobOffer')->getJobOfferResponseByUser($jobOffer, $this->getUser());

			return $this -> render('FrontOfficeEmploiBundle:Profil:listMyResponseJobOffers.html.twig', 
				array('jobOffer'              => $jobOffer,
					  'jobOfferResponses'     => $jobOfferResponseByUser));					
	}
}

