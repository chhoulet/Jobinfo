<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminFormationController extends Controller
{
    public function showFormationAction()
    {
    	$em = $this -> getDoctrine()-> getManager();
    	$showFormation = $em -> getRepository('FrontOfficeHomepageBundle:Formation')->findAll();

        return $this->render('BackOfficeBundle:AdminFormation:showFormation.html.twig', array('showFormation' => $showFormation));
    }
}
