<?php

namespace App\DataFixtures;

use App\Entity\County;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

final class CountyFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $countyEntity = new County();
        $countyEntity->setTitle('Bellville');
        $countyEntity->setShortCode('ZAF-WC-BEL');
        $countyEntity->setState($this->getReference(StateFixtures::STATE_WC_REFERENCE));
        $manager->persist($countyEntity);
        $manager->flush();

        $countyEntity = new County();
        $countyEntity->setTitle('Durbanville');
        $countyEntity->setShortCode('ZAF-WC-DUR');
        $countyEntity->setState($this->getReference(StateFixtures::STATE_WC_REFERENCE));
        $manager->persist($countyEntity);
        $manager->flush();

        $countyEntity = new County();
        $countyEntity->setTitle('Nelson Mandela Bay');
        $countyEntity->setShortCode('ZAF-EC-NMB');
        $countyEntity->setState($this->getReference(StateFixtures::STATE_EC_REFERENCE));
        $manager->persist($countyEntity);
        $manager->flush();

        $countyEntity = new County();
        $countyEntity->setTitle('Eden District');
        $countyEntity->setShortCode('ZAF-EC-ED');
        $countyEntity->setState($this->getReference(StateFixtures::STATE_EC_REFERENCE));
        $manager->persist($countyEntity);
        $manager->flush();

        $countyEntity = new County();
        $countyEntity->setTitle('Pretoria');
        $countyEntity->setShortCode('ZAF-EC-PRE');
        $countyEntity->setState($this->getReference(StateFixtures::STATE_GA_REFERENCE));
        $manager->persist($countyEntity);
        $manager->flush();

        $countyEntity = new County();
        $countyEntity->setTitle('Central');
        $countyEntity->setShortCode('ZAF-GAU-CEN');
        $countyEntity->setState($this->getReference(StateFixtures::STATE_GA_REFERENCE));
        $manager->persist($countyEntity);
        $manager->flush();

        $countyEntity = new County();
        $countyEntity->setTitle('Main Beach');
        $countyEntity->setShortCode('ZAF-KZN-MAI');
        $countyEntity->setState($this->getReference(StateFixtures::STATE_KZN_REFERENCE));
        $manager->persist($countyEntity);
        $manager->flush();

        $countyEntity = new County();
        $countyEntity->setTitle('Midlands');
        $countyEntity->setShortCode('ZAF-KZN-MID');
        $countyEntity->setState($this->getReference(StateFixtures::STATE_KZN_REFERENCE));
        $manager->persist($countyEntity);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CountryFixtures::class,
            StateFixtures::class,
        ];
    }
}
