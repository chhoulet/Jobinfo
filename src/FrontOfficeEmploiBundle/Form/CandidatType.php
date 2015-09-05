<?php

namespace FrontOfficeEmploiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CandidatType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', 'text',    array('label'=>'Prénom',
                                                'attr' => array('placeholder'=>'Pierre, Rachid, Adriana ...')))
            ->add('lastname', 'text',     array('label'=>'Nom',
                                                'attr' => array('placeholder'=>'Nom de famille')))
            ->add('street', 'text',       array('label'=>'Rue',
                                                'attr' => array('placeholder'=>'Rue de Maubeuge')))
            ->add('city', 'text',         array('label'=>'Ville',
                                                'attr' => array('placeholder'=>'Ville de résidence')))
            ->add('postcode', 'integer',  array('label'=>'Code Postal',
                                                'attr' => array('placeholder'=>'51, 78, 93, 13, 46 ... ')))
            ->add('phoneNumber','integer',array('label'=>'Téléphone',
                                                'attr' => array('placeholder'=>'0000000000 Saisissez un numéro de 10 chiffres !')))
            ->add('Valider','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeEmploiBundle\Entity\Candidat'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'frontofficeemploibundle_candidat';
    }
}
