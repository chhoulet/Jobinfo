<?php

namespace FrontOfficeUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FrontOfficeUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
