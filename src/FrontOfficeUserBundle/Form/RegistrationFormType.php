<?php

namespace FrontOfficeUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends AbstractType
{    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'choice', array('label'=>'Etes-vous ?',
                                          'choices'=> array('candidat'=>'Candidat',
                                                            'society' =>'Société',
                                          'expanded'=> true)))            
            
        ;
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }   

    public function getName()
    {
        return 'front_office_user_registration';
    }
}
