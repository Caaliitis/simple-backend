<?php

namespace App\Repository;

use App\Entity\CertificateCompany;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CertificateCompany|null find($id, $lockMode = null, $lockVersion = null)
 * @method CertificateCompany|null findOneBy(array $criteria, array $orderBy = null)
 * @method CertificateCompany[]    findAll()
 * @method CertificateCompany[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CertificateCompanyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CertificateCompany::class);
    }

    // /**
    //  * @return CertificateCompany[] Returns an array of CertificateCompany objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CertificateCompany
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
