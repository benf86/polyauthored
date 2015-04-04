<?php

namespace AppBundle\Form\General;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('points')
            ->add('content')
            ->add('entityParent')
            ->add('worldParent')
            ->add('postParent')
            ->add('userParent')
            ->add('commentParent')
            ->add('author')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\General\Comment'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_general_comment';
    }
}
