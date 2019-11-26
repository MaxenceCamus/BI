<?php

namespace App\Repository;

use App\Entity\FaitPipeline;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FaitPipeline|null find($id, $lockMode = null, $lockVersion = null)
 * @method FaitPipeline|null findOneBy(array $criteria, array $orderBy = null)
 * @method FaitPipeline[]    findAll()
 * @method FaitPipeline[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FaitPipelineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FaitPipeline::class);
    }

    // /**
    //  * @return FaitPipeline[] Returns an array of FaitPipeline objects
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
    public function findOneBySomeField($value): ?FaitPipeline
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function valuespipeline($year)
    {
        return $this->createQueryBuilder('p')
            ->addSelect('p.total_valeur','p.prb')
            ->andWhere('p.year = :y')
            ->setParameter('y', $year)
            ->groupBy('p.prb')
            ->getQuery()
            ->getResult();
    }
}
