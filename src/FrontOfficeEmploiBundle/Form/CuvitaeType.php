<?php

namespace FrontOfficeEmploiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CuvitaeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text',           array('label'=>'Titre',
                                                  'attr' => array('placeholder'=>'Developpeur Symfony, Administrateur Réseaux, Développeur Zend...')))
            ->add('gradeOne','text',        array('label'=>'Diplôme 1',
                                                  'attr' => array('placeholder'=>'Ingénieur informatique,...')))
            ->add('gradeTwo','text',        array('label'=>'Diplôme 2',
                                                  'attr' => array('placeholder'=>'Licence de développement Web...')))
            ->add('languages','text',       array('label'=>'Langues parlées',
                                                  'attr' => array('placeholder'=>'Anglais, Allemand, Espagnol ...')))
            ->add('workExperience1','text', array('label'=>'Expérience professionnelle 1',
                                                  'attr' => array('placeholder'=>'De la plus récente à la plus ancienne, par ex : Ingénieur développement chez Orange')))
            ->add('workExperience2','text', array('label'=>'Expérience professionnelle 2',
                                                  'attr' => array('placeholder'=>'Stage en alternance chez BirdOffice')))
            ->add('skills','text',          array('label'=>'Compétences informatiques',
                                                  'attr' => array('placeholder'=>'PHP, Javascript, Java, Rubis, Python, ...')))
            ->add('valider','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeEmploiBundle\Entity\Cuvitae'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'frontofficeemploibundle_cuvitae';
    }
}
