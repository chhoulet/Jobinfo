<?php

namespace FrontOfficeEmploiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ResponseJobOfferType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', 'text',           array('label'=>'Réponse',
                                                     'attr' => array('placeholder'=>'Objet de la réponse ...')))
            ->add('motivationLetter', 'text',  array('label'=>'Choisissez une lettre de motivation'))
            ->add('cuvitae', 'text',           array('label'=>'Choisissez un CV'))
            ->add('Valider','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeEmploiBundle\Entity\ResponseJobOffer'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'frontofficeemploibundle_responsejoboffer';
    }
}
