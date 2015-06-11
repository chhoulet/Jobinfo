<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Etablissement;
use FrontOfficeBundle\Form\EtablissementType;
use Symfony\Component\HttpFoundation\Request;

class AdminEtablissementController extends Controller
{
	public function listAction()
	{
		$em = $this -> getDoctrine()-> getmanager();
		$list = $em -> getRepository('FrontOfficeHomepageBundle:Etablissement') -> findAll();

		return $this -> render('BackOfficeBundle:AdminEtablissement:list.html.twig', array('list'=>$list));
	}
}