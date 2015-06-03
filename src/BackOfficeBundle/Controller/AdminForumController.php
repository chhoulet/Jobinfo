<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminForumController extends Controller
{
	public function showForumsAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$showForums = $em -> getRepository('FrontOfficeHomepageBundle:Forum')->findAll();

		return $this -> render('BackOfficeBundle:AdminForum:showForums.html.twig', array('showForums'=> $showForums));
	}
}