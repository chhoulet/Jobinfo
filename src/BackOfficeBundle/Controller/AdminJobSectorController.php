<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeEmploiBundle\Entity\JobSector;
use FrontOfficeEmploiBundle\Form\JobSectorType;
use Symfony\Component\HttpFoundation\Request;

class AdminJobSectorController extends Controller
{
	public function listAction()
	{
		$em = $this -> getDoctrine()-> getManager();
		$listJobSector = $em -> getRepository('FrontOfficeEmploiBundle:JobSector')->findAll();

		return $this -> render('BackOfficeBundle:AdminJobSector:list.html.twig', array('listJobSector'=>$listJobSector));
	}

	public function createAction(Request $request)
	{
		$em = $this -> getDoctrine()-> getManager();
		$jobSector = new JobSector();
		$formJob = $this -> createForm(new JobSectorType(), $jobSector);

		$formJob -> handleRequest($request);

		if ($formJob -> isValid())
		{
			$em -> persist($jobSector);
			$em -> flush();

			return $this -> redirect($this->generateUrl('back_office_adminJobSector_list'));
		}

		return $this -> render('BackOfficeBundle:AdminJobSector:create.html.twig', array('formJob'=>$formJob->createView()));
	}
}