<?php

namespace FrontOfficeHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeHomepageBundle\Entity\Comment;
use FrontOfficeHomepageBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;


class BlogController extends Controller
{
	public function showArticlesAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$showArticles = $em -> getRepository('FrontOfficeHomepageBundle:Article')->findAll();

		return $this -> render('FrontOfficeHomepageBundle:Blog:showArticles.html.twig', 
			array('showArticles'=>$showArticles));
	}

	public function showOneArticleAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		/*$showOneArticle = $em ->getRepository('FrontOfficeHomepageBundle:Article')->find($id);*/
		$comment = new Comment();
		$article = $em -> getRepository('FrontOfficeHomepageBundle:Article')->find($id);
		$formComment = $this -> createForm(new CommentType(), $comment);

		$formComment -> handleRequest($request);

		if($formComment -> isValid())
		{
			$comment -> setDateCreated(new \DateTime('now'));
			$comment -> setArticle($article);
			$em ->persist($comment);
			$em ->flush();

			return $this -> redirect($this -> generateUrl('front_office_homepage_blog_oneArticle', ['id'=>$id]));
		}
	
		return $this -> render('FrontOfficeHomepageBundle:Blog:showOneArticle.html.twig', 
			array('showOneArticle' =>$article,
				  'formComment'=>$formComment->createView()));
	}

	public function triArticlesAction($category)
	{
		$em = $this -> getDoctrine()->getManager();
		$articles = $em -> getRepository('FrontOfficeHomepageBundle:Article')-> triArticlesByCategory($category);

		return $this -> render('FrontOfficeHomepageBundle:Blog:showArticles.html.twig', 
			array('showArticles'=> $articles));
	}

}