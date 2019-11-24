<?php

namespace App\Repository;

use App\Entity\DimensionCommercial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DimensionCommercial|null find($id, $lockMode = null, $lockVersion = null)
 * @method DimensionCommercial|null findOneBy(array $criteria, array $orderBy = null)
 * @method DimensionCommercial[]    findAll()
 * @method DimensionCommercial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DimensionCommercialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DimensionCommercial::class);
    }

    // /**
    //  * @return DimensionCommercial[] Returns an array of DimensionCommercial objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DimensionCommercial
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
