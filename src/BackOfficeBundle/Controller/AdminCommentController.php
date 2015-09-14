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

	public function censoreAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$censoredComment = $em -> getRepository('FrontOfficeHomepageBundle:Comment')->find($id);
		$censoredComment -> setMessage('Ce message est supprimé car il ne respecte pas les conditions d\'utilisation du site');
		$censoredComment -> setCensored(true);
		$censoredComment -> setDateCensored(new \datetime());
		$em -> flush();

		$session -> getFlashbag()-> add('cens','Ce commentaire est censuré');
		return $this -> redirect($request -> headers -> get('referer'));
	}

	public function listCensoredAction()
	{
		$em = $this -> getDoctrine()-> getManager();
		$listCensored = $em -> getRepository('FrontOfficeHomepageBundle:Comment') -> getCensoredComments();
		$nbCensoredByAuthor = $em -> getRepository('FrontOfficeHomepageBundle:Comment') -> getauthorByNbCommentsCensored();

		return $this ->render('BackOfficeBundle:AdminComment:listCensored.html.twig', 
			array('listCensored'      => $listCensored,
				  'nbCensoredByAuthor'=> $nbCensoredByAuthor));
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