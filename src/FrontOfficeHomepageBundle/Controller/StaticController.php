<?php

namespace FrontOfficeHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StaticController extends Controller
{
	public function mentionsAction()
	{
		return $this-> render('FrontOfficeHomepageBundle:Static:mentions.html.twig');
	}

	public function conditionsAction()
	{
		return $this-> render('FrontOfficeHomepageBundle:Static:conditions.html.twig');
	}
}