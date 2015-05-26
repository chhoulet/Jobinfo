<?php

namespace FrontOfficeHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
	public function showArticlesAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$showArticles = $em -> getRepository('FrontOfficeHomepageBundle:Article')->findAll();

		return $this -> render('FrontOfficeHomepageBundle:Blog:showArticles.html.twig', array('showArticles'=>$showArticles));
	}

	public function showOneArticleAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$showOneArticle = $em ->getRepository('FrontOfficeHomepageBundle:Article')->find($id);

		return $this -> render('FrontOfficeHomepageBundle:Blog:showOneArticle.html.twig', array('showOneArticle' =>$showOneArticle));
	}

}