<?php

namespace FrontOfficeEmploiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class JobOfferType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text',           array('label'   =>'Titre',
                                                  'attr'    => array('placeholder'=>'Developpeur Symfony, Administrateur Réseaux, Développeur Zend...')))
            ->add('descriptionJob','text',  array('label'   =>'Description du poste',
                                                  'attr'    => array('placeholder'=>'Saisissez votre texte')))
            ->add('place', null,            array('label'   =>'Ville où se situe le poste à pourvoir'))
            ->add('contract', 'choice',     array('label'   =>'Contrat proposé',
                                                  'choices' => array('Stage'=>'Stage',
                                                                     'CDD'=>'CDD',
                                                                     'CDI'=>'CDI',
                                                                     'Alternance'=>'Alternance')))
            ->add('jobSector', null,        array('label'   =>'Domaine technique'))
            ->add('valider','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeEmploiBundle\Entity\JobOffer'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'frontofficeemploibundle_joboffer';
    }
}