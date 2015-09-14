<?php

namespace FrontOfficeHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeHomepageBundle\Entity\Comment;
use FrontOfficeHomepageBundle\Entity\Article;
use FrontOfficeHomepageBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;


class BlogController extends Controller
{
	# Page d'accueil du blog, articles indifférenciés et affichage de la liste des catégories:
	public function showArticlesAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$listCategory = $em -> getRepository('FrontOfficeHomepageBundle:Category')->findAll();
		$showArticles = $em -> getRepository('FrontOfficeHomepageBundle:Article')->getArticles();

		return $this -> render('FrontOfficeHomepageBundle:Blog:showArticles.html.twig', 
			array('showArticles'=> $showArticles,
				  'listCategory'=> $listCategory));
	}

	# Vue d'un article et de ses commentaires, mis en ligne avant leur validation:	
	public function oneArticleAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()-> getManager();
		$session = $request -> getSession();
		$oneArticle = $em -> getRepository('FrontOfficeHomepageBundle:Article')->find($id);
		$listCategory = $em -> getRepository('FrontOfficeHomepageBundle:Category')->findAll();
		$comment = new Comment();
		$form = $this -> createForm(new CommentType(), $comment);

		$form -> handleRequest($request);

		if($form -> isValid())
		{			
			$comment -> setAuthor($this -> getUser());
			$comment -> setDateCreated(new \datetime('now'));
			$comment -> setCensored(false);
			$comment -> setArticle($oneArticle);
			$comment -> setValidAdmin(false);
			$em -> persist($comment);
			$em -> flush();

			$session -> getFlashbag()-> add('succes', 'Merci pour votre commentaire !');
			return $this->redirect($request -> headers -> get('referer'));
		}

		return $this -> render('FrontOfficeHomepageBundle:Blog:oneArticle.html.twig',
		    array('oneArticle'  => $oneArticle,
		    	  'listCategory'=> $listCategory,
		    	  'form'        => $form -> createView()));
	}

	# Tri des articles par category, avec envoi de la liste des categories
	# pour activer les liens et appel de la query qui trie les articles en fonction de celle-ci:
	public function triArticlesAction($category)
	{
		$em = $this -> getDoctrine()->getManager();
		$listCategory = $em -> getRepository('FrontOfficeHomepageBundle:Category')->findAll();
		$articles = $em -> getRepository('FrontOfficeHomepageBundle:Article')-> triArticlesByCategory($category);

		return $this -> render('FrontOfficeHomepageBundle:Blog:articlesByCategories.html.twig', 
			array('showArticles'=> $articles,
				  'listCategory'=> $listCategory
				  ));
	}	

}