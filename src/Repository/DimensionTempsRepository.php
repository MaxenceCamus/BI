<?php

namespace App\Repository;

use App\Entity\DimensionTemps;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DimensionTemps|null find($id, $lockMode = null, $lockVersion = null)
 * @method DimensionTemps|null findOneBy(array $criteria, array $orderBy = null)
 * @method DimensionTemps[]    findAll()
 * @method DimensionTemps[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DimensionTempsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DimensionTemps::class);
    }

    public function yearDistinct()
    {
        return $this->createQueryBuilder('p')
            ->groupBy('p.year')
            ->orderBy('p.year', 'desc')
            ->getQuery()->getResult();
    }
    public function monthDistinct()
    {
        return $this->createQueryBuilder('p')
            ->groupBy('p.month')
            ->orderBy('p.month', 'asc')
            ->getQuery()->getResult();
    }
}
