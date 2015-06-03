<?php 

namespace FrontOfficeHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeHomepageBundle\Entity\Subscriber;
use FrontOfficeHomepageBundle\Entity\Formation;
use FrontOfficeHomepageBundle\Entity\Forum;
use FrontOfficeHomepageBundle\Form\SubscriberType;
use Symfony\Component\HttpFoundation\Request;

class SubscriberController extends Controller
{
	public function registrationFormationAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()-> getManager();
		$formation = $em -> getRepository('FrontOfficeHomepageBundle:Formation')->find($id);
		$subscriber = new Subscriber();
		$formFormationSubscriber = $this -> createForm(new SubscriberType(), $subscriber);

		$formFormationSubscriber -> handleRequest($request);

		if($formFormationSubscriber -> isValid())
		{
			$subscriber -> setDateSubscribed(new \DateTime('now'));
			$subscriber -> setFormation($formation);
			$em -> persist($subscriber);
			$em -> flush();

			return $this -> redirect($this-> generateUrl('front_office_homepage_homepage'));
		}

		return $this-> render('FrontOfficeHomepageBundle:Subscriber:registrationFormation.html.twig',
		    array('formFormationSubscriber'=>$formFormationSubscriber->createView()));
	}

	public function registrationForumAction(Request $request, $id)
	{
		$em = $this -> getDoctrine()->getManager();
		$forum = $em -> getRepository('FrontOfficeHomepageBundle:Forum')->find($id);
		$subscriber = new Subscriber();
		$formForumSubscriber = $this -> createForm(new SubscriberType(), $subscriber);

		$formForumSubscriber -> handleRequest($request);

		if($formForumSubscriber -> isValid())
		{
			$subscriber -> addForum($forum);
			$subscriber -> setDateSubscribed(new \DateTime('now'));
			$em -> persist($subscriber);
			$em -> flush();

			return $this -> redirect($this -> generateUrl('front_office_subscriber_forum', array('id'=>$id)));
		}

		return $this -> render('FrontOfficeHomepageBundle:Subscriber:registrationForum.html.twig', 
			array('formForumSubscriber'=> $formForumSubscriber->createView()));


	}
}