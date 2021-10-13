<?php

namespace App\Repository;

use DateTime;
use DateInterval;
use App\Entity\Adversing;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Adversing|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adversing|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adversing[]    findAll()
 * @method Adversing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdversingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adversing::class);
    }

    public function getActiveAds()
    {
        $today   = new \DateTime();
        return $this->createQueryBuilder('a')
            ->andWhere('a.EndAt >= :to')
            ->andWhere('a.IsValid = :valid')
            ->setParameter('to', $today)
            ->setParameter('valid',true)
            ->getQuery()
            ->getResult()
            ;
    }
    
    /**
     * 
     */
    public function AdversingHomePage()
    {
        $to   = new \DateTime();
        $to->add(new DateInterval('P7D'));

        return $this->createQueryBuilder('a')
            ->andWhere('a.StartAt BETWEEN :from AND :to')
            ->setParameter('from', new \DateTime('now'))
            ->setParameter('to', $to)
            ->getQuery()
            ->getResult()
        ;
    }
    
    // /**
    //  * @return Adversing[] Returns an array of Adversing objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Adversing
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
