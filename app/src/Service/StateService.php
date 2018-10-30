<?php

namespace App\Service;

use App\Entity\State;
use App\Entity\TaxData;
use Doctrine\ORM\EntityManagerInterface;

final class StateService
{
    /** @var EntityManagerInterface */
    private $em;

    /**
     * PostService constructor.
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
    public function create(string $title): State
    {
        $stateEntity = new State();
        $stateEntity->setTitle($title);
        $this->em->persist($stateEntity);
        $this->em->flush();

        return $stateEntity;
    }

    /**
     * @return object[]
     */
    public function getAll(): array
    {
        return $this->em->getRepository(State::class)->findBy([], ['id' => 'DESC']);
    }

    /**
     * Function to fetch all tax data for a given State
     * @return State[]
     */
    public function getAllWithTaxData(): array
    {
        return $this->em->getRepository(State::class)
                    ->createQueryBuilder('s')
                    ->select('s.title', 's.short_code', 't.total_amount','t.average_rate')
                    ->join(
                        TaxData::class,
                        't',
                        \Doctrine\ORM\Query\Expr\Join::WITH,
                        't.entity_id = s.id'
                    )
                    ->where('t.entity_type = :entity_type')
                    ->setParameter('entity_type', "state")
                    ->getQuery()
                    ->getResult();
    }
}
