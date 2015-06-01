<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeHomepageBundle\Entity\Article;
use FrontOfficeHomepageBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;

class AdminArticleController extends Controller
{
	public function createArticleAction(Request $request)
	{
		$em = $this -> getDoctrine()-> getManager();
		$article = new Article();
		$formArticle = $this ->createForm(new ArticleType(), $article);

		$formArticle -> handleRequest($request);

		if($formArticle -> isValid())
		{
			/*$article -> setAuthorName($this -> getUser());*/
			$article -> setDateCreated(new \DateTime('now'));	
			$article -> setDateUpdated(new \DateTime('now'));
			$em -> persist($article);
			$em -> flush();

			return $this-> redirect($this -> generateUrl('front_office_homepage_blog_article'));
		}

		return $this -> render('BackOfficeBundle:AdminArticle:createArticle.html.twig',
			array('formArticle'=>$formArticle->createView()));
	}
}