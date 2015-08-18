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
		$session = $request ->getSession();
		$formArticle = $this ->createForm(new ArticleType(), $article);

		$formArticle -> handleRequest($request);

		if($formArticle -> isValid())
		{
			$article -> setAuthor($this -> getUser());
			$article -> setDateCreated(new \DateTime('now'));	
			$em -> persist($article);
			$em -> flush();

			$session -> getFlashbag()->add('succes','L\'article est ajouté dans le blog !');
			return $this-> redirect($this -> generateUrl('front_office_homepage_blog_article'));
		}

		return $this -> render('BackOfficeBundle:AdminArticle:createArticle.html.twig',
			array('formArticle'=>$formArticle->createView()));
	}

	public function editArticleAction(Request $request,$id)
	{
		$em = $this -> getDoctrine()->getManager();	
		$session = $request -> getSession();
		$editArticle = $em -> getRepository('FrontOfficeHomepageBundle:Article')->find($id);
		$formEditArticle = $this -> createForm(new ArticleType(), $editArticle);

		$formEditArticle -> handleRequest($request);

		if($formEditArticle -> isValid())
		{
			$editArticle -> setDateUpdated(new \DateTime('now'));
			$em -> persist($editArticle);
			$em -> flush();

			$session -> getFlashbag()->add('article','Votre article a bien été corrigé !');
			return $this ->redirect($request -> headers -> get('referer'));
		}

		return $this -> render('BackOfficeBundle:AdminArticle:editArticle.html.twig', 
			array('formEditArticle'=> $formEditArticle ->createView()));
	}

	public function deleteArticleAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$deleteArticle = $em -> getRepository('FrontOfficeHomepageBundle:Article')->find($id);
		$em -> remove($deleteArticle);
		$em -> flush();

		$session -> getFlashbag()->add('suppr','Cet article est bien supprimé du blog !');
		return $this -> redirect($request -> headers -> get('referer'));
	}

	public function listAction()
	{
		$em = $this -> getDoctrine()->getManager();	
		$listArticles = $em -> getRepository('FrontOfficeHomepageBundle:Article')->findAll();

		return $this -> render('BackOfficeBundle:AdminArticle:list.html.twig', array('listArticles' => $listArticles));
	}
}
