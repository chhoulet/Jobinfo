<?php

namespace FrontOfficeEmploiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeEmploiBundle\Entity\Society;
use FrontOfficeEmploiBundle\Form\SocietyType;
use Symfony\Component\HttpFoundation\Request;


class EmployerController extends Controller
{
	public function createSocietyAction(Request $request)
	{
		$em = $this -> getDoctrine()->getManager();
		$society = new Society();
		$formSociety = $this -> createForm(new SocietyType(), $society);

		$formSociety -> handleRequest($request);

		if($formSociety -> isValid())
		{
			$society -> setDateCreated(new \DateTime('now'));
			$em -> persist($society);
			$em -> flush();

			return $this -> redirect($this -> generateUrl('front_office_homepage_homepage'));
		}

		return $this -> render('FrontOfficeEmploiBundle:Employer:createSociety.html.twig', array('formSociety'=>$formSociety->createView()));
	}
}