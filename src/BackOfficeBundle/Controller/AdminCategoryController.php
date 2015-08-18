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
		$session = $request -> getSession();
		$category = new Category();
		$form = $this -> createForm(new CategoryType(), $category);

		$form -> handleRequest($request);

		if($form -> isValid()){
			$em -> persist($category);
			$em -> flush();

			$session -> getFlashbag()->add('succes','La nouvelle categorie est bien ajoutée dans la base !');
			return $this -> redirect($request -> headers -> get('referer'));
		}

		return $this -> render('BackOfficeBundle:AdminCategory:new.html.twig', 
			array('form'=> $form -> createView()));
	}
}