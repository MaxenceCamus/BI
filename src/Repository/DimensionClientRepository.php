<?php

namespace App\Repository;

use App\Entity\DimensionClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DimensionClient|null find($id, $lockMode = null, $lockVersion = null)
 * @method DimensionClient|null findOneBy(array $criteria, array $orderBy = null)
 * @method DimensionClient[]    findAll()
 * @method DimensionClient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DimensionClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DimensionClient::class);
    }

    // /**
    //  * @return DimensionClient[] Returns an array of DimensionClient objects
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
    public function findOneBySomeField($value): ?DimensionClient
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
