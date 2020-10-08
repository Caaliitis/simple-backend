<?php

namespace App\Repository;

use App\Entity\ProductClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductClass[]    findAll()
 * @method ProductClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductClassRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductClass::class);
    }

    // /**
    //  * @return ProductClass[] Returns an array of ProductClass objects
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
    public function findOneBySomeField($value): ?ProductClass
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
