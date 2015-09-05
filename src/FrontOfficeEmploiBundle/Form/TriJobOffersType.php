<?php

namespace FrontOfficeEmploiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TriJobOffersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder            
            ->add('contract', 'choice',  array('choices' => array('sta'=>'Stage',
                                                                  'cdd'=>'CDD',
                                                                  'cdi'=>'CDI',
                                                                  'alt'=>'Alternance')))
            ->add('place', null)
            ->add('jobSector', 'choice', array('choices' => array('Devel' => 'Développement',
                                                                  'Inte'  => 'Intégration',
                                                                  'BigD'  => 'Big Data',
                                                                  'Rese'  => 'Réseaux')))
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