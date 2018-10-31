<?php

namespace App\DataFixtures;

use App\Entity\TaxData;
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
        $countyEntity = new TaxData();
        $countyEntity->setTitle('Bellville');
        $countyEntity->setShortCode('ZAF-WC-BEL');
        $countyEntity->setEntityType('county');
        $countyEntity->setTotalAmount(9000000.00);
        $countyEntity->setAverageRate(25.00);
        $countyEntity->setParent($this->getReference(StateFixtures::STATE_WC_REFERENCE));
        $manager->persist($countyEntity);
        $manager->flush();

        $countyEntity = new TaxData();
        $countyEntity->setTitle('Durbanville');
        $countyEntity->setShortCode('ZAF-WC-DUR');
        $countyEntity->setEntityType('county');
        $countyEntity->setTotalAmount(5000000.00);
        $countyEntity->setAverageRate(25.00);
        $countyEntity->setParent($this->getReference(StateFixtures::STATE_WC_REFERENCE));
        $manager->persist($countyEntity);
        $manager->flush();

        $countyEntity = new TaxData();
        $countyEntity->setTitle('Nelson Mandela Bay');
        $countyEntity->setShortCode('ZAF-EC-NMB');
        $countyEntity->setEntityType('county');
        $countyEntity->setTotalAmount(1000000.00);
        $countyEntity->setAverageRate(20.00);
        $countyEntity->setParent($this->getReference(StateFixtures::STATE_EC_REFERENCE));
        $manager->persist($countyEntity);
        $manager->flush();

        $countyEntity = new TaxData();
        $countyEntity->setTitle('Eden District');
        $countyEntity->setShortCode('ZAF-EC-ED');
        $countyEntity->setEntityType('county');
        $countyEntity->setTotalAmount(100000000.00);
        $countyEntity->setAverageRate(15.00);
        $countyEntity->setParent($this->getReference(StateFixtures::STATE_EC_REFERENCE));
        $manager->persist($countyEntity);
        $manager->flush();

        $countyEntity = new TaxData();
        $countyEntity->setTitle('Pretoria');
        $countyEntity->setShortCode('ZAF-EC-PRE');
        $countyEntity->setEntityType('county');
        $countyEntity->setTotalAmount(1000000.00);
        $countyEntity->setAverageRate(15.00);
        $countyEntity->setParent($this->getReference(StateFixtures::STATE_GA_REFERENCE));
        $manager->persist($countyEntity);
        $manager->flush();

        $countyEntity = new TaxData();
        $countyEntity->setTitle('Central');
        $countyEntity->setShortCode('ZAF-GAU-CEN');
        $countyEntity->setEntityType('county');
        $countyEntity->setTotalAmount(100000000.00);
        $countyEntity->setAverageRate(29.00);
        $countyEntity->setParent($this->getReference(StateFixtures::STATE_GA_REFERENCE));
        $manager->persist($countyEntity);
        $manager->flush();

        $countyEntity = new TaxData();
        $countyEntity->setTitle('Main Beach');
        $countyEntity->setShortCode('ZAF-KZN-MAI');
        $countyEntity->setEntityType('county');
        $countyEntity->setTotalAmount(1000000.00);
        $countyEntity->setAverageRate(18.00);
        $countyEntity->setParent($this->getReference(StateFixtures::STATE_KZN_REFERENCE));
        $manager->persist($countyEntity);
        $manager->flush();

        $countyEntity = new TaxData();
        $countyEntity->setTitle('Midlands');
        $countyEntity->setShortCode('ZAF-KZN-MID');
        $countyEntity->setEntityType('county');
        $countyEntity->setTotalAmount(14500000.00);
        $countyEntity->setAverageRate(26.00);
        $countyEntity->setParent($this->getReference(StateFixtures::STATE_KZN_REFERENCE));
        $manager->persist($countyEntity);
        $manager->flush();

        $countyEntity = new TaxData();
        $countyEntity->setTitle('Dry Beach');
        $countyEntity->setShortCode('ZAF-NWT-DBH');
        $countyEntity->setEntityType('county');
        $countyEntity->setTotalAmount(45000000.00);
        $countyEntity->setAverageRate(21.00);
        $countyEntity->setParent($this->getReference(StateFixtures::STATE_NW_REFERENCE));
        $manager->persist($countyEntity);
        $manager->flush();

        $countyEntity = new TaxData();
        $countyEntity->setTitle('Sutherland');
        $countyEntity->setShortCode('ZAF-NWT-STD');
        $countyEntity->setEntityType('county');
        $countyEntity->setTotalAmount(1000000.00);
        $countyEntity->setAverageRate(15.00);
        $countyEntity->setParent($this->getReference(StateFixtures::STATE_NW_REFERENCE));
        $manager->persist($countyEntity);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            StateFixtures::class,
        ];
    }
}
