<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeHomepageBundle\Entity\Formation;
use FrontOfficeHomepageBundle\Form\FormationType;
use Symfony\Component\HttpFoundation\Request;

class AdminFormationController extends Controller
{
    public function showFormationAction()
    {
    	$em = $this -> getDoctrine()-> getManager();
    	$showFormation = $em -> getRepository('FrontOfficeHomepageBundle:Formation')->findAll();

        return $this->render('BackOfficeBundle:AdminFormation:showFormation.html.twig', array('showFormation' => $showFormation));
    }

    public function editFormationAction(Request $request, $id)
    {
    	$em = $this -> getDoctrine()->getManager();
    	$editFormation = $em -> getRepository('FrontOfficeHomepageBundle:Formation')->find($id);
    	$formFormation = $this -> createForm(new FormationType(), $editFormation);

    	$formFormation -> handleRequest($request);

    	if($formFormation -> isValid())
    	{
    		$editFormation -> setUpdatedAt(new \DateTime('now'));
    		$em -> persist($editFormation);
    		$em -> flush();

            return $this -> redirect($this -> generateUrl('front_office_formation_showOne', array('id'=>$id)));
    	}

        return $this -> render('BackOfficeBundle:AdminFormation:editFormation.html.twig', array('formFormation'=>$formFormation));
    }
}
