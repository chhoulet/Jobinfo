<?php

namespace FrontOfficeHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    public function homepageAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$articles = $em -> getRepository('FrontOfficeHomepageBundle:Article') ->getArticles();
    	$formations = $em ->getRepository('FrontOfficeHomepageBundle:Formation') ->getLastFormations();
    	$forums = $em ->getRepository('FrontOfficeHomepageBundle:Forum')->getForums();



        return $this->render('FrontOfficeHomepageBundle:Homepage:homepage.html.twig', 
        	array('articles'  =>$articles,
        	      'formations'=>$formations,
        	      'forums'    =>$forums));
    }
}
