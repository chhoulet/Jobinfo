<?php

namespace FrontOfficeUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends AbstractType
{    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'choice', array('label'=>'Etes-vous ?',
                                          'choices'=> array('candidat'=>'Candidat',
                                                            'society' =>'Société',
                                          'expanded'=> true)))            
            ->add('Valider','submit')
        ;
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }   

    public function getName()
    {
        return 'user_registration';
    }
}
