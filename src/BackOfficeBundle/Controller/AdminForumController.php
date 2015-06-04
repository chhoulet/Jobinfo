<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeHomepageBundle\Entity\Forum;
use FrontOfficeHomepageBundle\Form\ForumType;
use Symfony\Component\HttpFoundation\Request;

class AdminForumController extends Controller
{
	public function listAction()
	{
		$em = $this -> getDoctrine()->getManager();
		$showForums = $em -> getRepository('FrontOfficeHomepageBundle:Forum')->findAll();

		return $this -> render('BackOfficeBundle:AdminForum:showForums.html.twig', 
			array('showForums'=> $showForums));
	}

	public function newAction(Request $request)
	{
		$em = $this -> getDoctrine()->getManager();
		$forum = new Forum();
		$formForum = $this -> createForm(new ForumType(), $forum);

		$formForum -> handleRequest($request);
		if($formForum -> isValid())
		{
			$em -> persist($forum);
			$em -> flush();

			return $this -> redirect($this -> generateUrl('back_office_adminforum_show'));
		}

		return $this -> render('BackOfficeBundle:AdminForum:new.html.twig', 
			array('formForum' => $formForum ->createView()));
	}

	public function editAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$forum = $em -> getRepository('FrontOfficeHomepageBundle:Forum')->find($id);
		$formForum = $this -> createForm(new ForumType(), $forum);

		$formForum -> handleRequest($request);

		if($formForum -> isValid())
		{
			$em -> persist($forum);
			$em -> flush();
			return $this -> redirect($this->generateUrl('back_office_adminforum_list'));
		}

		return $this -> render('BackOfficeBundle:AdminForum:edit.html.twig', 
			array('formForum'=>$formForum->createView()));
	}
}