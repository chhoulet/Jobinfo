<?php

namespace FrontOfficeHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ForumController extends Controller
{
	# Liste des forums par type, déterminés en homepage :
	public function listAction($forumType)
	{
		$em = $this -> getDoctrine()->getManager();
		$forums = $em -> getRepository('FrontOfficeHomepageBundle:Forum')->getForums($forumType);

		return $this -> render('FrontOfficeHomepageBundle:Forum:forum.html.twig', array('forums'=>$forums));
	}

	# Vue d'un forum 
	public function oneForumAction($id)
	{
		$em = $this -> getDoctrine()->getManager();
		$oneForum = $em -> getRepository('FrontOfficeHomepageBundle:Forum')->find($id);
		$forumByInscrit = $em -> getRepository('FrontOfficeHomepageBundle:Forum')->getForumByInscrit($oneForum, $this -> getuser());		

		return $this -> render('FrontOfficeHomepageBundle:Forum:oneForum.html.twig', 
			array('oneForum'=> $oneForum,
				  'forumByInscrit'=> $forumByInscrit));
	}

	# Inscription a un forum par ajout d'un user dans la jointable user_forum:
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

	# Desinscription d'un user d'un forum:
	public function desinscriptionForumAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$session = $request -> getSession();
		$forum = $em -> getRepository('FrontOfficeHomepageBundle:Forum')->find($id);
		$forum -> removeInscrit($this -> getUser());
		$em -> flush();

		$session -> getFlashbag()->add('notice','Votre désinscription est bien prise en compte');
		return ($this -> redirect($request -> headers -> get('referer')));
	}
}