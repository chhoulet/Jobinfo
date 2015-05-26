<?php

namespace FrontOfficeHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class CommentController extends Controller
{
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

		return $this-> render('FrontOfficeHomepageBundle:Comment:createComment.html.twig', array('formComment'=>$formComment->createView()));
	}

	public function showComments($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$article_id = $em -> getRepository('FrontOfficeHomepageBundle:Article')->find($id);
		$showComments = $em -> getRepository('FrontOfficeHomepageBundle:Comment')->getComments($article_id);

		return $this->render('FrontOfficeHomepageBundle:Comment:showComments.html.twig', array('showComments'=>$showComments));
	}
}