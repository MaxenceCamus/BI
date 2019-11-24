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

    public function test(){
        $this->createQueryBuilder('p')
            ->select('p.id, p.total_valeur')
            ->innerJoin('p.pays_id', 'pays')
            ->andWhere('pays = 1');
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
}
