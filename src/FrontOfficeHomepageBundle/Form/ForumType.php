<?php

namespace FrontOfficeHomepageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ForumType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('forumName')
            ->add('forumType')
            ->add('forumDate')
            ->add('forumDescription')
            ->add('forumAdress')
            ->add('Valider','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeHomepageBundle\Entity\Forum'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'frontofficehomepagebundle_forum';
    }
}
