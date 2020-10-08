<?php

namespace App\Repository;

use App\Entity\BlacklistCause;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlacklistCause|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlacklistCause|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlacklistCause[]    findAll()
 * @method BlacklistCause[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlacklistCauseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlacklistCause::class);
    }

    // /**
    //  * @return BlacklistCause[] Returns an array of BlacklistCause objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BlacklistCause
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
