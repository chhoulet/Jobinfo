<?php

namespace FrontOfficeEmploiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfilController extends Controller
{	
	# Acces a son espace personnel via une requete DQL selectionnant le profil Candidat/Society en fonction de l'id de l'user logué:
	public function myProfilAction($user = null)
	{		
		$em = $this -> getDoctrine()->getManager();
		$myProfil = $em -> getRepository('FrontOfficeEmploiBundle:Candidat')->getCandidatByUser($this -> getUser());
		$myProfilSociety = $em -> getRepository('FrontOfficeEmploiBundle:Society')->getSocietyByUser($this -> getUser());

		return $this -> render('FrontOfficeEmploiBundle:Profil:myProfil.html.twig', 
			array('candidat'=> $myProfil,
				  'oneSociety' => $myProfilSociety));
	}		

	public function listMyJobOffersAction()
	{
		return $this -> render('FrontOfficeEmploiBundle:Profil:listMyJobOffers.html.twig');
	}
}