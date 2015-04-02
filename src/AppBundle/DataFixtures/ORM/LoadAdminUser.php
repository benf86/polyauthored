<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\User\User;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setPassword('test');
        $userAdmin->setEmail('admin@admin.lan');
        $userAdmin->setName('Admin I. Strator');
        $userAdmin->setEnabled(true);
        $userAdmin->setRoles(array('ROLE_SUPER_ADMIN'));

        $hash = $this->container->get('security.password_encoder')->encodePassword($userAdmin, 'admin');
        $userAdmin->setPassword($hash);
        
        $manager->persist($userAdmin);
        $manager->flush();
    }
}