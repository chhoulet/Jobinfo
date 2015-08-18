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

        return $this->render('BackOfficeBundle:AdminFormation:showFormation.html.twig', 
            array('showFormation' => $showFormation));
    }

    public function editFormationAction(Request $request, $id)
    {
    	$em = $this -> getDoctrine()->getManager();
        $session = $request -> getSession();
    	$editFormation = $em -> getRepository('FrontOfficeHomepageBundle:Formation')->find($id);
    	$formFormation = $this -> createForm(new FormationType(), $editFormation);

    	$formFormation -> handleRequest($request);

    	if($formFormation -> isValid())
    	{
    		$editFormation -> setUpdatedAt(new \DateTime('now'));
    		$em -> persist($editFormation);
    		$em -> flush();

            $session -> getFlashbag()->add('succes','La formation a bien été modifiée dans la base !');
            return $this -> redirect($this -> generateUrl('back_office_adminformation_show'));
    	}

        return $this -> render('BackOfficeBundle:AdminFormation:editFormation.html.twig', 
            array('formFormation'=>$formFormation->createView()));
    }

    public function createFormationAction(Request $request)
    {
        $em = $this -> getDoctrine()->getManager();
        $formation = new Formation();
        $formCreationFormation = $this -> createForm(new FormationType(), $formation);

        $formCreationFormation -> handleRequest($request);
        
        if($formCreationFormation -> isValid())
        {
            $formation -> setCreatedAt(new \DateTime('now'));            
            $em -> persist($formation);
            $em -> flush();

            return $this -> redirect($this -> generateUrl('back_office_adminformation_show'));
        }

        return $this -> render('BackOfficeBundle:AdminFormation:createFormation.html.twig', 
            array('formCreationFormation'=>$formCreationFormation->createView()));
    }

    public function deleteFormationAction($id)
    {
        $em = $this -> getDoctrine()->getManager();
        $editFormation = $em -> getRepository('FrontOfficeHomepageBundle:Formation')->find($id);
        $em -> remove($editFormation);
        $em -> flush();

        return $this -> redirect($this->generateUrl('back_office_adminformation_show'));
    }   
}
