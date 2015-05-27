<?php

namespace FrontOfficeHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    public function homepageAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$articles = $em -> getRepository('FrontOfficeHomepageBundle:Article') ->getArticles();
    	$formation = $em ->getRepository('FrontOfficeHomepageBundle:Formation') ->getLastFormations();
    	$forum = $em ->getRepository('FrontOfficeHomepageBundle:Forum')->getLastForum();
        $societe = $em -> getRepository('FrontOfficeEmploiBundle:Society')-> getSociety();

        return $this->render('FrontOfficeHomepageBundle:Homepage:homepage.html.twig', 
        	array('articles'  =>$articles,
        	      'formation' =>$formation,
        	      'forum'     =>$forum,
                  'societe'   =>$societe));
    }
}
