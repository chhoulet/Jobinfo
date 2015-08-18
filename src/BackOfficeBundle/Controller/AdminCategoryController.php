<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeHomepageBundle\Entity\Category;
use FrontOfficeHomepageBundle\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;

class AdminCategoryController extends Controller
{
	public function newAction(Request $request)
	{
		$em = $this -> getDoctrine()->getManager();
		$category = new Category();
		$form = $this -> createForm(new CategoryType(), $category);

		$form -> handleRequest($request);

		if($form -> isValid()){
			$em -> persist($category);
			$em -> flush();

			return $this -> redirect($this -> generateUrl('back_office_homepage'));
		}

		return $this -> render('BackOfficeBundle:AdminCategory:new.html.twig', 
			array('form'=> $form -> createView()));
	}
}