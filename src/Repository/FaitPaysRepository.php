<?php

namespace App\Repository;

use App\Entity\FaitPays;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FaitPays|null find($id, $lockMode = null, $lockVersion = null)
 * @method FaitPays|null findOneBy(array $criteria, array $orderBy = null)
 * @method FaitPays[]    findAll()
 * @method FaitPays[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FaitPaysRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FaitPays::class);
    }

    // /**
    //  * @return FaitPays[] Returns an array of FaitPays objects
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
    public function findOneBySomeField($value): ?FaitPays
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findValuesByCountry($year)
    {
        return $this->createQueryBuilder('p')
            ->select('SUM(p.total_valeur) as total_valeur, pays.code_pays')
            ->andWhere('p.year = :y')
            ->setParameter('y', $year)
            ->innerJoin('p.pays','pays')
            ->groupBy('p.pays')
            ->getQuery()
            ->execute();
    }
}
