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

	# Vue d'un article et de ses commentaires, mis en ligne après leur validation:
	public function showOneArticleAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$comment = new Comment();
		$oneArticle = $em -> getRepository('FrontOfficeHomepageBundle:Article')-> find($id);
				
		# Selection des comments valides rattachés à l'article selectionne(id en parametre);
		$comments = $em -> getRepository('FrontOfficeHomepageBundle:Comment') -> getCommentsValidated($oneArticle);
		$form = $this -> createForm(new CommentType(), $comment);
	
		$form -> handleRequest($request);

		if ($form -> isValid())
		{
			$comment -> setDateCreated(new \DateTime('now'));
			$comment -> setValidAdmin(false);			
			$comment -> setArticle($oneArticle);
			$em -> persist($comment);
			$em -> flush();

			/*Message flash*/
			$session -> getFlashbag()->add('notice','Votre commentaire est enregistré. Il sera publié après validation !');
			return $this -> redirect($request -> headers -> get('referer'));
		}

		return $this -> render('FrontOfficeHomepageBundle:Blog:showOneArticle.html.twig', 
			array('showOneArticle'=> $oneArticle,
				  'comments'      => $comments,
				  'form'          => $form -> createView()));
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