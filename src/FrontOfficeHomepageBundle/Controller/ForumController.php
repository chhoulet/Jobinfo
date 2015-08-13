<?php

namespace FrontOfficeHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ForumController extends Controller
{
	public function listAction($forumType)
	{
		$em = $this -> getDoctrine()->getManager();
		$forums = $em -> getRepository('FrontOfficeHomepageBundle:Forum')->getForums($forumType);

		return $this -> render('FrontOfficeHomepageBundle:Forum:forum.html.twig', array('forums'=>$forums));
	}

	public function oneForumAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$oneForum = $em -> getRepository('FrontOfficeHomepageBundle:Forum')->find($id);

		return $this -> render('FrontOfficeHomepageBundle:Forum:oneForum.html.twig', array('oneForum'=>$oneForum));
	}

	public function inscriptionAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$forum = $em -> getRepository('FrontOfficeHomepageBundle:Forum')->find($id);
		$forum -> addInscrit($this -> getUser());
		$em -> flush();

		$session -> getFlashbag() -> add('succes','Votre inscription à ce forum est bien prise en compte !');
		return $this ->redirect($request -> headers -> get('referer'));		
	}
}