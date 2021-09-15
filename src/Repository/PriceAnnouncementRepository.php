<?php

namespace App\Repository;

use App\Entity\PriceAnnouncement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PriceAnnouncement|null find($id, $lockMode = null, $lockVersion = null)
 * @method PriceAnnouncement|null findOneBy(array $criteria, array $orderBy = null)
 * @method PriceAnnouncement[]    findAll()
 * @method PriceAnnouncement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PriceAnnouncementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PriceAnnouncement::class);
    }

    // /**
    //  * @return PriceAnnouncement[] Returns an array of PriceAnnouncement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PriceAnnouncement
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
