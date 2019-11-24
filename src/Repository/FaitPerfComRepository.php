<?php

namespace App\Repository;

use App\Entity\FaitPerfCom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FaitPerfCom|null find($id, $lockMode = null, $lockVersion = null)
 * @method FaitPerfCom|null findOneBy(array $criteria, array $orderBy = null)
 * @method FaitPerfCom[]    findAll()
 * @method FaitPerfCom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FaitPerfComRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FaitPerfCom::class);
    }

    // /**
    //  * @return FaitPerfCom[] Returns an array of FaitPerfCom objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FaitPerfCom
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
