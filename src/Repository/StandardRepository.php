<?php

namespace App\Repository;

use App\Entity\Standard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Standard|null find($id, $lockMode = null, $lockVersion = null)
 * @method Standard|null findOneBy(array $criteria, array $orderBy = null)
 * @method Standard[]    findAll()
 * @method Standard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StandardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Standard::class);
    }

    // /**
    //  * @return Standard[] Returns an array of Standard objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Standard
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
