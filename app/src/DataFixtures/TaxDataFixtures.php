<?php

namespace App\DataFixtures;

use App\Entity\TaxData;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

final class TaxDataFixtures extends Fixture
{
    public const COUNTRY_ZA_REFERENCE = 'country-za';

    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $countryEntity = new TaxData();
        $countryEntity->setTitle('South Africa');
        $countryEntity->setShortCode('ZAF');
        $countryEntity->setEntityType('country');
        $manager->persist($countryEntity);
        $manager->flush();

        $this->addReference(self::COUNTRY_ZA_REFERENCE, $countryEntity);
    }
}
