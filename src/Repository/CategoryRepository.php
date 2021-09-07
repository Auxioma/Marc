<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }  
  
    /**
     * @return Category[] Returns an array of Category objects
     */
    public function RandCategory()
    {
        // SELECT * FROM `category` a join `category` ON a.id = category.parent_id group by a.name 
        return $this->createQueryBuilder('c')
            ->getQuery()
            ->getResult()
        ;
    }
    
    /**
     * @return Category[] Returns an array of Category objects
     */
    public function Menu()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.Parent = :val')
            ->setParameter('val', '1')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Category[] Returns an array of Category objects
     */
    public function SubMenu($SubCategory)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.Parent = :val')
            ->setParameter('val', $SubCategory)
            ->getQuery()
            ->getResult()
        ;
    }
}
