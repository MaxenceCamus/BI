<?php

namespace App\Repository;

use App\Entity\DimensionPays;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DimensionPays|null find($id, $lockMode = null, $lockVersion = null)
 * @method DimensionPays|null findOneBy(array $criteria, array $orderBy = null)
 * @method DimensionPays[]    findAll()
 * @method DimensionPays[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DimensionPaysRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DimensionPays::class);
    }

    // /**
    //  * @return DimensionPays[] Returns an array of DimensionPays objects
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
    public function findOneBySomeField($value): ?DimensionPays
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
