<?php

namespace App\Repository;

use App\Entity\ReplacementAdvertising;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReplacementAdvertising|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReplacementAdvertising|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReplacementAdvertising[]    findAll()
 * @method ReplacementAdvertising[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReplacementAdvertisingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReplacementAdvertising::class);
    }

    /**
     * return array[]
     */
    public function AdversingRemplacement()
    {
        return $this->createQueryBuilder('r')->getQuery()->getResult();
    }
}
