<?php

namespace FrontOfficeHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeHomepageBundle\Entity\Comment;
use FrontOfficeHomepageBundle\Entity\Article;
use FrontOfficeHomepageBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;


class BlogController extends Controller
{
	# Page d'accueil du blog, articles indifférenciés:
	public function showArticlesAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$showArticles = $em -> getRepository('FrontOfficeHomepageBundle:Article')->getArticles();

		return $this -> render('FrontOfficeHomepageBundle:Blog:showArticles.html.twig', 
			array('showArticles'=>$showArticles));
	}

	# Vue d'un article et de ses commentaires, mis en ligne avant leur validation:
	
	public function oneArticleAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()-> getManager();
		$session = $request -> getSession();
		$oneArticle = $em -> getRepository('FrontOfficeHomepageBundle:Article')->find($id);
		$comment = new Comment();
		$form = $this -> createForm(new CommentType(), $comment);

		$form -> handleRequest($request);

		if($form -> isValid())
		{
			var_dump($form);
			$comment -> setAuthor($this -> getUser());
			$comment -> setDateCreated(new \datetime('now'));
			$comment -> setArticle($oneArticle);
			$comment -> setValidAdmin(false);
			$em -> persist($comment);
			$em -> flush();

			$session -> getFlashbag()-> add('succes', 'Merci pour votre commentaire !');
			return $this->redirect($request -> headers -> get('referer'));
		}

		return $this -> render('FrontOfficeHomepageBundle:Blog:oneArticle.html.twig',
		    array('oneArticle'=> $oneArticle,
		    	  'form'      => $form -> createView()));
	}

	# Tri des articles par category:
	public function triArticlesAction($category)
	{
		$em = $this -> getDoctrine()->getManager();
		$articles = $em -> getRepository('FrontOfficeHomepageBundle:Article')-> triArticlesByCategory($category);

		return $this -> render('FrontOfficeHomepageBundle:Blog:showArticles.html.twig', 
			array('showArticles'=> $articles));
	}

	public function listAction()
	{
		$em = $this -> getDoctrine()-> getManager();
		$listCategory = $em -> getRepository('FrontOfficeHomepageBundle:Category')->findAll();
		
		return $this -> render('FrontOfficeHomepageBundle:Slots:sidebar.html.twig', 
			array('listCategory'=>$listCategory));
	}

}