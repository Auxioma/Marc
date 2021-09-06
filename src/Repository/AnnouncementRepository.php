<?php

namespace App\Repository;

use DateInterval;
use App\Entity\Announcement;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository; 

/**
 * @method Announcement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Announcement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Announcement[]    findAll()
 * @method Announcement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnouncementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Announcement::class);
    }

    /**
     * @return Announcement[] Returns an array of Announcement objects
     */
    public function PreniumOffert()
    {
        $to   = new \DateTime();
        $to->add(new DateInterval('P20D'));
        
        return $this->createQueryBuilder('a')
            ->andWhere('a.IsVerified = :val')
            ->setParameter('val', '1')
            ->andWhere('a.Offert = :Offert')
            ->setParameter('Offert', '1') // 1 the VIP offert
            ->andWhere('a.StartAt BETWEEN :from AND :to')
            ->setParameter('from', new \DateTime('now'))
            ->setParameter('to', $to)

            ->setMaxResults(50)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Announcement
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
