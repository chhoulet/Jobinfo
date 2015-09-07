<?php

namespace FrontOfficeHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeEmploiBundle\Entity\JobOffer;
use FrontOfficeEmploiBundle\Form\TriJobOffersType;
use Symfony\Component\HttpFoundation\Request;


class HomepageController extends Controller
{
    public function homepageAction(Request $request)
    {
        #Selection des différents éléments mis en page d'accueil :
    	$em = $this->getDoctrine()->getManager();
    	$articles = $em -> getRepository('FrontOfficeHomepageBundle:Article') ->getArticles();
    	$formation = $em ->getRepository('FrontOfficeHomepageBundle:Formation') ->getLastFormations();
    	$forum = $em ->getRepository('FrontOfficeHomepageBundle:Forum')->getLastForum();
        $jobOffers = $em ->getRepository('FrontOfficeEmploiBundle:JobOffer')->getJobOffers();

        #Formulaire de selection des  offres d'emploi par critères :
        $formJobOffers = $this -> createForm(new TriJobOffersType());
        $formJobOffers -> handleRequest($request);

        if($formJobOffers ->isValid())
        {
            # Recuperation des éléments du formulaire pour hydrater les parametres de la requete:
            $datas = $formJobOffers -> getData();
           
            $jobOffersByTri = $em -> getRepository('FrontOfficeEmploiBundle:JobOffer')-> triJobOffers($datas ->getContract(), $datas->getJobSector(), $datas->getPlace());                  
            return $this -> render('FrontOfficeEmploiBundle:JobOffer:triJobOffer.html.twig', array('jobOffersByTri'=>$jobOffersByTri));
        }

        return $this->render('FrontOfficeHomepageBundle:Homepage:homepage.html.twig', 
        	array('articles'      =>$articles,
        	      'formation'     =>$formation,
        	      'forum'         =>$forum,             
                  'jobOffers'     =>$jobOffers,
                  'formJobOffers' =>$formJobOffers->createView()));
    }
}

 
