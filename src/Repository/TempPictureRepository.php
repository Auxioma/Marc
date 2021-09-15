<?php

namespace App\Repository;

use App\Entity\TempPicture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TempPicture|null find($id, $lockMode = null, $lockVersion = null)
 * @method TempPicture|null findOneBy(array $criteria, array $orderBy = null)
 * @method TempPicture[]    findAll()
 * @method TempPicture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TempPictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TempPicture::class);
    }

    // /**
    //  * @return TempPicture[] Returns an array of TempPicture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TempPicture
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
