<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeHomepageBundle\Entity\Subscriber;

class AdminSubscriberController extends Controller
{
	public function viewAction()
	{
		$em = $this -> getDoctrine()-> getManager();
		#Tri des subscriber par type de formation
		$subFormation = $em ->getRepository('FrontOfficeHomepageBundle:Subscriber')-> getSubscriberByFormation();
		#Tri des subscriber par nom de formation
		$subNameFormation = $em ->getRepository('FrontOfficeHomepageBundle:Subscriber')-> triSubscriber();
		#Tri des subscriber par type de forum
		$subForum = $em -> getRepository('FrontOfficeHomepageBundle:Subscriber')-> getSubscriberByForum();
		#Tri des subscriber par nom de forum
		$subNameForum = $em -> getRepository('FrontOfficeHomepageBundle:Subscriber')-> triSubscriberByForumName();

		return $this-> render('BackOfficeBundle:AdminSubscriber:view.html.twig', 
			array('subFormation'     => $subFormation,
				  'subNameFormation' => $subNameFormation,
				  'subForum'         => $subForum,
				  'subNameForum'     => $subNameForum));

	}
}