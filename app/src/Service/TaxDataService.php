<?php

namespace App\Service;

use App\Entity\TaxData;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;

final class TaxDataService
{
    /** @var EntityManagerInterface */
    private $em;

    /**
     * TaxDataService constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $title
     * @return TaxData
     */
    public function create(string $title): TaxData
    {
        $taxDataEntity = new TaxData();
        $taxDataEntity->setTitle($title);
        $this->em->persist($taxDataEntity);
        $this->em->flush();
        return $taxDataEntity;
    }

    /**
     * @return TaxData
     */
    public function getOne(int $id): TaxData
    {
        return $this->em->getRepository(TaxData::class)->findOneBy(['id' => $id], ['id' => 'DESC']);
    }

    /**
     * @return TaxData[]
     */
    public function getAll(): array
    {
        return $this->em->getRepository(TaxData::class)->findBy([], ['id' => 'DESC']);
    }

    /**
     * Function to fetch all tax data for states
     * @param string $entity_type
     * @return TaxData[]
     */
    public function getAllByType($entity_type): array
    {
        return $this->em->getRepository(TaxData::class)
                    ->createQueryBuilder('t')
                    ->where('t.entity_type = :entity_type')
                    ->setParameter('entity_type', $entity_type)
                    ->getQuery()
                    ->getResult();
    }

    /**
     * @return Country[]
     */
    public function updateTax(): void
    {
        $countries = $this->em->getRepository(TaxData::class)
                    ->createQueryBuilder('t')
                    ->where('t.entity_type = :entity_type')
                    ->setParameter('entity_type', "country")
                    ->getQuery()
                    ->getResult();

        foreach($countries as $country) {

            $average_rate_country = 0.00;
            $total_amount_country = 0.00;

            $states = $country->getChildren();

            foreach($states as $state) {

                $counties = $state->getChildren();

                $average_rate = 0.00;
                $total_amount = 0.00;

                foreach($counties as $county) {
                    $total_amount += $county->getTotalAmount();
                    $average_rate += $county->getAverageRate();
                }

                if(count($counties)) {
                    $average_rate = $average_rate / count($counties);
                    $average_total_amount = $total_amount / count($counties);
                }

                $state->setAverageRate($average_rate);
                $state->setTotalAmount($total_amount);
                $state->setAverageTotalAmount($average_total_amount);
                $this->em->merge($state);
                $this->em->flush();

                if($state) {
                    $total_amount_country += $state->getTotalAmount();
                    $average_rate_country += $state->getAverageRate();
                }
                
            }

            $average_rate_country = $average_rate_country / count($states);
            $average_total_amount_country = $total_amount_country / count($states);

            $country->setAverageRate($average_rate_country);
            $country->setTotalAmount($total_amount_country);
            $country->setAverageTotalAmount($average_total_amount_country);
            $this->em->merge($country);
            $this->em->flush();
        }
        
    }
}