<?php

namespace AppBundle\Form\Story;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('points')
            ->add('title')
            ->add('content')
            ->add('world')
            ->add('keywords')
            ->add('owner')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Story\Story'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_story_story';
    }
}
