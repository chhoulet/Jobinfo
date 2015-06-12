<?php

namespace FrontOfficeHomepageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FormationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('formationName')
            ->add('organism')
            ->add('formationDate','date')
            ->add('formationType', 'choice', array('choices'=>array('devWeb'      =>'Développement Web',
                                                                    'Integration' =>'Intégration',
                                                                    'devMob'      =>'Développement d\'applications mobiles',
                                                                    'reseaux'     =>'Administration de réseaux',
                                                                    'bdd'         =>'Gestion de Bases de Données')))
            ->add('formationDescription')
            ->add('valider', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeHomepageBundle\Entity\Formation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'frontofficehomepagebundle_formation';
    }
}
