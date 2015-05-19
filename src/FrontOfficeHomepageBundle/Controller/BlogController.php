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

	public function createCommentAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$comment = new Comment();
		$article = $em -> getRepository('FrontOfficeHomepageBundle:Article')->find($id);
		$formComment = $this -> createForm(new CommentType(), $comment);

		$formComment -> handleRequest($request);

		if($formComment -> isValid())
		{
			$comment -> setDateCreated(new \Date('now'));
			$comment -> setArticle($article);
			$em ->persist($comment);
			$em ->flush();

			return $this -> redirect($this -> generateUrl('front_office_homepage_blog_oneArticle_comment', array('id'=>$id)));
		}

		return $this-> render('FrontOfficeHomepageBundle:Blog:createComment.html.twig', array('$formComment'=>$formComment->createView()));
	}
}