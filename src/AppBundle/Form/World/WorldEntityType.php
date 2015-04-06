<?php

namespace AppBundle\Form\World;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WorldEntityType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('content')
            ->add('approved', 'checkbox', array("required" => false))
            ->add('world')
            ->add('name')
            ->add('owner')
            ->add('published')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\World\WorldEntity'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_world_worldentity';
    }
}
