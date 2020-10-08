<?php

namespace App\Repository;

use App\Entity\Countries;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Countries|null find($id, $lockMode = null, $lockVersion = null)
 * @method Countries|null findOneBy(array $criteria, array $orderBy = null)
 * @method Countries[]    findAll()
 * @method Countries[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Countries::class);
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findCountAll()
	{
		return $this->createQueryBuilder('countries')
			->select('count(countries.id)')
			->getQuery()
			->getSingleScalarResult()
			;
	}

    /**
     * @param bool $filter
     * @param int $orderColumn
     * @param string $orderDir
     * @return \Doctrine\ORM\QueryBuilder
     */
	public function findAllQueryBuilder($filter = false, $orderColumn = 0, $orderDir = 'ASC'){
		$qb = $this->createQueryBuilder('countries');

		if($filter){
			$qb->andWhere('LOWER(countries.country) LIKE :filter')->setParameter('filter', '%'.strtolower($filter).'%');
		}

		$qb->orderBy($this->getColumnsOrder($orderColumn), $orderDir);

		return $qb;
	}

    /**
     * @param $orderColumn
     * @return mixed
     */
	protected function getColumnsOrder($orderColumn)
	{
		$array = array(0 => 'countries.id', 1 => 'countries.countries');

		return $array[$orderColumn];
	}
}
