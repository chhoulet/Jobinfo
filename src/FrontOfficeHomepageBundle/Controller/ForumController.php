<?php

namespace FrontOfficeHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}