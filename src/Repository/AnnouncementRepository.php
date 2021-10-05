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
            ->andWhere('a.options = :Offert')
            ->setParameter('Offert', 1) // 1 the VIP offert
            ->andWhere(':now BETWEEN a.StartAt AND a.EndAt')
            ->setParameter('now', new \DateTime('now'))
            ->setMaxResults(50)
            ->getQuery()
            ->getResult()
        ;
    }
    
    /**
     * @return Announcement[] Returns an array of Announcement objects
     */
    public function AnnonceForTheCategory($id, $filter)
    {
        $to   = new \DateTime();
        $to->add(new DateInterval('P20D'));
        
        $db =  $this->createQueryBuilder('a');
        $db->andWhere('a.IsVerified = :val');
        $db->setParameter('val', '1');

        $db->andWhere('a.Category = :Category');
        $db->setParameter('Category', $id);

        if ($filter > 2) {
            $db->andWhere('a.options = :offert');
            $db->setParameter('offert', 2) ;
        } 
        
        if ($filter == '1' ) {
            $db->andWhere('a.options = :offert');
            $db->setParameter('offert', 0) ;
        }
        if ($filter == 2 ) {
            $db->andWhere('a.options = :offert');
            $db->setParameter('offert', 1) ;
        }              
        if ($filter == 0 ) {
            $db->andWhere('a.options = :offert');
            $db->setParameter('offert', 0) ;
        }

        return $db;

    }
    public function pagination($id)
    {
        $db =  $this->createQueryBuilder('a');
        $db->andWhere('a.IsVerified = :val');
        $db->setParameter('val', '1');
        $db->andWhere('a.Category = :Category');
        $db->setParameter('Category', $id);                 
        return $db;
    }
    /**
     * @return Announcement[] Returns an array of Announcement objects
     */
    public function NewOffert()
    {
        return   $this->createQueryBuilder('a')
            ->andWhere('a.IsVerified = :val')
            ->setParameter('val', '1')
            ->setMaxResults(10)                
            ->getQuery()
            ->getResult()
        ;
    }
}
