<?php

namespace AppBundle\Form\Story;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use AppBundle\Entity\Story\Story;

class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content')
            ->add('synopsis')
            ->add('title')
            ->add('keywords')
            ->add('postChildren')
            ->add('postParents')
            ->add('published', 'checkbox', array('value'=>'unchecked', 'required'=>false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Story\Post'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_story_post';
    }
}
