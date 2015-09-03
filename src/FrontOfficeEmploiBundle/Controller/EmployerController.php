<?php

namespace FrontOfficeEmploiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeEmploiBundle\Entity\Society;
use FrontOfficeEmploiBundle\Entity\JobOffer;
use FrontOfficeEmploiBundle\Form\SocietyType;
use FrontOfficeEmploiBundle\Form\JobOfferType;
use Symfony\Component\HttpFoundation\Request;


class EmployerController extends Controller
{
	# Instantiation de l'objet Society + message flash:
	public function createSocietyAction(Request $request)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$society = new Society();
		$formSociety = $this -> createForm(new SocietyType(), $society);

		$formSociety -> handleRequest($request);

		if($formSociety -> isValid())
		{
			$society -> setDateCreated(new \DateTime('now'));
			$society -> setUser($this -> getUser()) -> setPersonnalSpaceActive(true);			
			$em -> persist($society);
			$em -> flush();

			$session ->getFlashbag()-> add('creasoc','Votre société est bien enregistrée dans la base !');
			return $this -> redirect($this -> generateUrl('front_office_homepage_homepage'));
		}

		return $this -> render('FrontOfficeEmploiBundle:Employer:createSociety.html.twig', 
			array('formSociety'=>$formSociety->createView()));
	}

	# Détail d'une society:
	public function oneSocietyAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$oneSociety = $em ->getRepository('FrontOfficeEmploiBundle:Society') -> find($id);

		return $this -> render('FrontOfficeEmploiBundle:Employer:oneSociety.html.twig', array('oneSociety'=> $oneSociety));
	}

	# Instantiation de l'objet jobOffer + message flash:
	public function createJobOfferAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$jobOffer = new JobOffer();
		$society = $em -> getRepository('FrontOfficeEmploiBundle:Society')->find($id);
		$session = $request -> getSession();
		$formJobOffer = $this -> createForm(new JobOfferType(), $jobOffer);

		$formJobOffer -> handleRequest($request);

		if($formJobOffer -> isValid())
		{
			$jobOffer -> setDateCreated(new \DateTime('now'));
			$jobOffer -> setActiveToPurchase(true);
			$jobOffer -> addUser($this -> getUser());
			$jobOffer -> setSociety($society);
			$em -> persist($jobOffer);
			$em -> flush();

			$session ->getFlashbag()->add('creation','Votre offre d\'emploi est bien publiée !');
			return $this -> redirect($this -> generateUrl('front_office_homepage_homepage'));
		}

		return $this -> render('FrontOfficeEmploiBundle:Employer:createJobOffer.html.twig', 
			array('formJobOffer'=>$formJobOffer->createView()));
	}

	# Liste des sociétés qui recrutent, via un lien en homepage:
	public function listSocietiesAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$listSocieties = $em -> getRepository('FrontOfficeEmploiBundle:Society') -> getSocieties();

		return $this -> render('FrontOfficeEmploiBundle:Employer:listSocieties.html.twig', 
			array('listSocieties' => $listSocieties));
	}	

	# Function desactivant les jobOffers + message flash:
	public function desactivateJobOfferAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()-> getManager();
		$session = $request -> getSession();
		$desactivatedJobOffer = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer')->find($id);
		# Desactivation de l'attribut activeToPurchase:
		$desactivatedJobOffer -> setActiveToPurchase(false);
		$desactivatedJobOffer -> setDateDesactivation(new \DateTime('now'));
		$em -> flush();

		$session -> getFlashbag()-> add('succes','Cette offre d\'emploi est retirée du marché !');
		# Redirection sur la meme page:
		return $this -> redirect($request -> headers -> get('referer'));
	}

	# Function desactivant la society + message flash:
	public function desactivateSocietyAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$desactivatedSociety = $em -> getRepository('FrontOfficeEmploiBundle:Society')->find($id);
		# Desactivation de l'attribut hiringState:
		$desactivatedSociety -> setHiringState(false);
		$em -> flush();

		$session -> getFlashbag() -> add('notice','Votre société est retirée de la liste des sociétés qui recrutent !');
		# Redirection sur la meme page:
		return $this -> redirect($request -> headers -> get('referer'));
	}
}