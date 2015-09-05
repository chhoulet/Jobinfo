<?php

namespace FrontOfficeEmploiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SocietyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text',        array('label'   =>'Raison sociale',
                                              'attr'    => array('placeholder'=>'Nom de l\'entreprise')))
            ->add('activity','text',    array('label'   =>'Secteur d\'activité',
                                              'attr'    => array('placeholder'=>'Agence interactive, Covoiturage, Web Services, Télécoms, ...')))
            ->add('description','text', array('label'   =>'Votre métier',
                                              'attr'    => array('placeholder'=>'Fournisseur de services de ...')))                        
            ->add('valider','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeEmploiBundle\Entity\Society'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'frontofficeemploibundle_society';
    }
}
