<?php

namespace FrontOfficeEmploiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfilController extends Controller
{	
	# Acces a son espace personnel via une requete DQL selectionnant le profil Candidat/Society 
	# en fonction de l'id de l'user logué:
	public function myProfilAction($user = null)
	{		
		$em = $this -> getDoctrine()->getManager();
		# Retourne le nombre d'offres selectionne par l'user:
		$nbJobOffersByUser = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer')->getNbJobOffersByUser($this ->getUser());				
		$type = $this -> getUser() ->getType();

		# Retourne les donnees 'candidat':
		if ($type == 'candidat'){
			$myProfil = $em -> getRepository('FrontOfficeEmploiBundle:Candidat')->getCandidatByUser($this -> getUser());			

			return $this -> render('FrontOfficeEmploiBundle:Profil:myProfil.html.twig', 
			array('nbJobOffersByUser'     => $nbJobOffersByUser,				  			
				  'candidat'              => $myProfil));
		}
		# Retourne les donnees 'employers':
		else{
			$myProfilSociety = $em -> getRepository('FrontOfficeEmploiBundle:Society')->getSocietyByUser($this -> getUser());

			return $this -> render('FrontOfficeEmploiBundle:Profil:myProfil.html.twig', 
			array('oneSociety'=> $myProfilSociety));
		}		
	}		

	# Alimentation en statistiques du tableau de bord des employeurs:
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

	# Retourne la liste des jobOffers obtenues en récupérant les donnees users via app.user:
	public function listMyJobOffersAction()
	{
		return $this -> render('FrontOfficeEmploiBundle:Profil:listMyJobOffers.html.twig');
	}

	# Retourne la liste des reponses envoyees/obtenues pour chaque jobOffer par les candidats / employeurs, 
	# selon une query 'getJobOfferResponseByUser' pour n'avoir pour les candidats que ses propres reponses. 
	# Pas besoin pour les employeurs, qui ont besoin d'avoir toutes les reponses indifferenciees:
	public function myResponseOneJobOfferAction($id)
	{
		$em = $this -> getDoctrine()->getManager();		
	
			$jobOffer = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer')->find($id);
			$jobOfferResponseByUser = $em -> getRepository('FrontOfficeEmploiBundle:ResponseJobOffer')->getJobOfferResponseByUser($jobOffer, $this->getUser());

			return $this -> render('FrontOfficeEmploiBundle:Profil:myResponseOneJobOffer.html.twig', 
				array('jobOffer'              => $jobOffer,
					  'jobOfferResponses'     => $jobOfferResponseByUser));					
	}
}

