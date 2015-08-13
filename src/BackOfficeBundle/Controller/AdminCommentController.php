<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeHomepageBundle\Comment;
use Symfony\Component\HttpFoundation\Request;

class AdminCommentController extends Controller
{
	public function commentUnvalidatedAction()
	{
		$em = $this -> getDoctrine()-> getManager();
		$commentUnvalidated = $em -> getRepository('FrontOfficeHomepageBundle:Comment')->getUnvalidatedComments();

		return $this -> render('BackOfficeBundle:AdminComment:getUnvalidatedComments.html.twig',
		   array('commentUnvalidated'=>$commentUnvalidated));
	}

	public function validationAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()-> getManager();
		$session = $request -> getSession();
		$validationComment = $em -> getRepository('FrontOfficeHomepageBundle:Comment')-> find($id);
		$validationComment -> setValidAdmin(true);
		$validationComment -> setDateValidated(new \datetime('now'));
		$em -> flush();

		$session -> getFlashbag()->add('succes','Ce commentaire est validé !');
		return $this -> redirect($request -> headers -> get('referer'));
	}

	public function deleteAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()-> getManager();
		$session = $request -> getSession();
		$comment = $em -> getRepository('FrontOfficeHomepageBundle:Comment')->find($id);
		$em -> remove($comment);
		$em -> flush();

		$session -> getFlashbag()->add('notice','Le commentaire sélectionné a bien été supprimé !');
		return $this -> redirect($request -> headers -> get('referer'));
	}
}