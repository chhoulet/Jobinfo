<?php

namespace FrontOfficeHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeHomepageBundle\Entity\Comment;
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
		$article = $em -> getRepository('FrontOfficeHomepageBundle:Article')->find($id);
		$formComment = $this -> createForm(new CommentType(), $comment);

		$formComment -> handleRequest($request);

		if($formComment -> isValid())
		{
			$comment -> setDateCreated(new \DateTime('now'));
			$comment -> setArticle($article);
			$comment -> setValidAdmin(false);
			$em ->persist($comment);
			$em ->flush();

			$session -> getFlashbag()->add('succes','Votre commentaire est ajouté !');
			return $this -> redirect($this -> generateUrl('front_office_homepage_blog_oneArticle', ['id'=>$id]));
		}
	
		return $this -> render('FrontOfficeHomepageBundle:Blog:showOneArticle.html.twig', 
			array('showOneArticle' =>$article,
				  'formComment'=>$formComment->createView()));
	}

	# Tri des articles par category:
	public function triArticlesAction($category)
	{
		$em = $this -> getDoctrine()->getManager();
		$articles = $em -> getRepository('FrontOfficeHomepageBundle:Article')-> triArticlesByCategory($category);

		return $this -> render('FrontOfficeHomepageBundle:Blog:showArticles.html.twig', 
			array('showArticles'=> $articles));
	}

}