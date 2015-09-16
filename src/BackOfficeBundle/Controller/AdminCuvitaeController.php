<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminCuvitaeController extends Controller
{
	public function listCuvitaeAction()
	{
		$em = $this -> getDoctrine()-> getManager();
		$listCuvitae = $em -> getRepository('FrontOfficeEmploiBundle:Cuvitae')-> findAll();

		return $this ->render ('BackOfficeBundle:AdminCuvitae:listCuvitae.html.twig', 
			array('listCuvitae'=> $listCuvitae));
	}
}