<?php

namespace App\Repository;

use App\Entity\DimensionOffreCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DimensionOffreCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method DimensionOffreCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method DimensionOffreCommande[]    findAll()
 * @method DimensionOffreCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DimensionOffreCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DimensionOffreCommande::class);
    }

    // /**
    //  * @return DimensionOffreCommande[] Returns an array of DimensionOffreCommande objects
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
    public function findOneBySomeField($value): ?DimensionOffreCommande
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
