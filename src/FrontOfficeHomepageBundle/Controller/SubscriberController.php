<?php 

namespace FrontOfficeHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeHomepageBundle\Entity\Subscriber;
use FrontOfficeHomepageBundle\Entity\Formation;
use FrontOfficeHomepageBundle\Entity\Forum;
use FrontOfficeHomepageBundle\Form\SubscriberType;

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
			$subscriber -> setDateSubscribed(new DateTime('now'));
			$subscriber -> setFormation($formation);
			$em -> persist($subscriber);
			$em -> flush();

			return $this -> redirect($this-> generateUrl('front_office_formation_oneFormation', array('id' => $id)));
		}

		return $this-> render('FrontOfficeHomepageBundle:Subscriber:registrationFormation.html.twig',
		  array('formFormationSubscriber'=>$formFormationSubscriber->createView()));
	}
}