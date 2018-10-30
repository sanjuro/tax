<?php

namespace App\Service;

use App\Entity\Country;
use App\Entity\TaxData;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;

final class CountryService
{
    /** @var EntityManagerInterface */
    private $em;

    /**
     * CountryService constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $title
     * @return State
     */
    public function create(string $title): Country
    {
        $countryEntity = new Country();
        $countryEntity->setTitle($title);
        $this->em->persist($countryEntity);
        $this->em->flush();
        return $countryEntity;
    }

    /**
     * @return Country
     */
    public function getOne(int $id): Country
    {
        return $this->em->getRepository(Country::class)->findOneBy(['id' => $id], ['id' => 'DESC']);
    }

    /**
     * @return Country[]
     */
    public function getAll(): array
    {
        return $this->em->getRepository(Country::class)->findBy([], ['id' => 'DESC']);
    }

    /**
     * Function to fetch all tax data for a given Country
     * @return Country[]
     */
    public function getAllWithTaxData(): array
    {
        return $this->em->getRepository(Country::class)
                    ->createQueryBuilder('c')
                    ->select('c.title', 'c.short_code', 't.total_amount','t.average_rate')
                    ->join(
                        TaxData::class,
                        't',
                        \Doctrine\ORM\Query\Expr\Join::WITH,
                        't.entity_id = c.id'
                    )
                    ->where('t.entity_type = :entity_type')
                    ->setParameter('entity_type', "country")
                    ->getQuery()
                    ->getResult();
    }

    /**
     * @return Country[]
     */
    public function updateTax(): void
    {
        $countries = $this->em->getRepository(Country::class)
                    ->createQueryBuilder('c')
                    ->getQuery()
                    ->getResult();

        foreach($countries as $country) {

            $criteria = array('entity_id' => $country->getId(), 'entity_type' => 'country');
            $tax_data_country = $this->em->getRepository(TaxData::class)->findOneBy($criteria);

            $average_rate_country = 0.00;
            $total_amount_country = 0.00;

            $states = $country->getStates();

            foreach($states as $state) {

                $criteria = array('entity_id' => $state->getId(), 'entity_type' => 'state');
                $tax_data_state = $this->em->getRepository(TaxData::class)->findOneBy($criteria);

                $counties = $state->getCounties();

                $average_rate = 0.00;
                $total_amount = 0.00;

                foreach($counties as $county) {
                    $criteria = array('entity_id' => $county->getId(), 'entity_type' => 'county');
                    $tax_data = $this->em->getRepository(TaxData::class)->findOneBy($criteria);
                    
                    if($tax_data) {
                        $total_amount += $tax_data->getTotalAmount();
                        $average_rate += $tax_data->getAverageRate();
                    }
                }

                $average_rate = $average_rate / count($counties);

                $tax_data_state->setAverageRate($average_rate);
                $tax_data_state->setTotalAmount($total_amount);
                $this->em->merge($tax_data_state);
                $this->em->flush();

                if($tax_data_state) {
                    $total_amount_country += $tax_data_state->getTotalAmount();
                    $average_rate_country += $tax_data_state->getAverageRate();
                }
                
            }

            $average_rate_country = $average_rate_country / count($states);
            $tax_data_country->setAverageRate($average_rate_country);
            $tax_data_country->setTotalAmount($total_amount_country);
            $this->em->merge($tax_data_country);
            $this->em->flush();
        }
        
    }
}