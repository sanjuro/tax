<?php

namespace App\DataFixtures;

use App\Entity\Country;
use App\Entity\State;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

final class UserFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $userEntity = new User();
        $userEntity->setLogin('josua');
        $userEntity->setPlainPassword('josua');
        $userEntity->setRoles(['ROLE_FOO']);
        $manager->persist($userEntity);
        $manager->flush();
    }
}
