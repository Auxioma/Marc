<?php

namespace App\Repository;

use App\Entity\PackageAdTextual;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PackageAdTextual|null find($id, $lockMode = null, $lockVersion = null)
 * @method PackageAdTextual|null findOneBy(array $criteria, array $orderBy = null)
 * @method PackageAdTextual[]    findAll()
 * @method PackageAdTextual[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PackageAdTextualRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PackageAdTextual::class);
    }


    public function findBytypeAsc($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.type = :val')
            ->setParameter('val', $value)
            ->orderBy('p.pricePerDay', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?PackageAdTextual
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
