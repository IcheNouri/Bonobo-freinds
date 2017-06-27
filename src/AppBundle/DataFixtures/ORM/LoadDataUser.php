<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Bonobo;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDataUser implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(\Doctrine\Common\Persistence\ObjectManager $manager)
    {
        $bonobo = new Bonobo();
        $bonobo->setNom("Best");
        $bonobo->setAge(15);
        $bonobo->setFamille("test");
        $bonobo->setRace("singe");
        $bonobo->setNouriiture("banane");

        $user = new User();
        $user->setUsername("admin");
        $user->setEmail("admin@gmail.com");
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->addBonobo($bonobo);

        $manager->persist($user);
        $manager->flush();
    }
}