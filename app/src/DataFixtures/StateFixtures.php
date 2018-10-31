<?php

namespace App\DataFixtures;

use App\Entity\TaxDAta;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

final class StateFixtures extends Fixture implements DependentFixtureInterface
{
    public const STATE_WC_REFERENCE = 'state-wc';
    public const STATE_EC_REFERENCE = 'state-ec';
    public const STATE_KZN_REFERENCE = 'state-kzn';
    public const STATE_GA_REFERENCE = 'state-ga';
    public const STATE_NW_REFERENCE = 'state-nw';

    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {

        $stateEntity = new TaxData();
        $stateEntity->setTitle('Western Cape');
        $stateEntity->setShortCode('ZAF-WC');
        $stateEntity->setEntityType('state');
        $stateEntity->setParent($this->getReference(TaxdataFixtures::COUNTRY_ZA_REFERENCE));
        $manager->persist($stateEntity);
        $manager->flush();

        $this->addReference(self::STATE_WC_REFERENCE, $stateEntity);

        $stateEntity = new TaxData();
        $stateEntity->setTitle('Eastern Cape');
        $stateEntity->setShortCode('ZAF-EC');
        $stateEntity->setEntityType('state');
        $stateEntity->setParent($this->getReference(TaxdataFixtures::COUNTRY_ZA_REFERENCE));
        $manager->persist($stateEntity);
        $manager->flush();

        $this->addReference(self::STATE_EC_REFERENCE, $stateEntity);

        $stateEntity = new TaxData();
        $stateEntity->setTitle('Kwazulu Natal');
        $stateEntity->setShortCode('ZAF-KZN');
        $stateEntity->setEntityType('state');
        $stateEntity->setParent($this->getReference(TaxdataFixtures::COUNTRY_ZA_REFERENCE));
        $manager->persist($stateEntity);
        $manager->flush();

        $this->addReference(self::STATE_KZN_REFERENCE, $stateEntity);

        $stateEntity = new TaxData();
        $stateEntity->setTitle('Gauteng');
        $stateEntity->setShortCode('ZAF-GAU');
        $stateEntity->setEntityType('state');
        $stateEntity->setParent($this->getReference(TaxdataFixtures::COUNTRY_ZA_REFERENCE));
        $manager->persist($stateEntity);
        $manager->flush();

        $this->addReference(self::STATE_GA_REFERENCE, $stateEntity);

        $stateEntity = new TaxData();
        $stateEntity->setTitle('North West');
        $stateEntity->setShortCode('ZAF-NWT');
        $stateEntity->setEntityType('state');
        $stateEntity->setParent($this->getReference(TaxdataFixtures::COUNTRY_ZA_REFERENCE));
        $manager->persist($stateEntity);
        $manager->flush();

        $this->addReference(self::STATE_NW_REFERENCE, $stateEntity);
    }

    public function getDependencies()
    {
        return [
            TaxDataFixtures::class,
        ];
    }
}
