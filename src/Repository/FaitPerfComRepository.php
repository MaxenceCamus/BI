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

    public function getPerfVendeurByYear($id_vendeur){
        return $this->createQueryBuilder('f')
            ->select('SUM(f.total_vente) as total, f.year')
            ->groupBy('f.year')
            ->where('f.groupe_vendeur = :id_vendeur')
            ->setParameter('id_vendeur', $id_vendeur)
            ->getQuery()
            ->getResult();
    }

    public function getPerfAllVendeurByMonth($id_annee){
        return $this->createQueryBuilder('f')
            ->groupBy('f.month', 'f.groupe_vendeur')
            ->where('f.year = :id_year')
            ->setParameter('id_year', $id_annee)
            ->orderBy('f.month')
            ->orderBy('f.groupe_vendeur')
            ->getQuery()
            ->getResult();
    }

    public function getTotalVentesByMonth($id_commercial, $year = null){

        $query = $this->createQueryBuilder('fpc')
            ->select('fpc.total_vente')
            ->addselect('fpc.month')
            ->addSelect('fpc.year')
            ->where('fpc.groupe_vendeur = :id_vendeur')
            ->setParameter('id_vendeur', $id_commercial)
            ->addOrderBy('fpc.year', 'ASC')
            ->addOrderBy('fpc.month', 'ASC');

        if($year !== null){
            $query->andWhere('fpc.year = :year')
                ->setParameter('year', $year);
        }

        return $query->getQuery()->getResult();
    }


    public function getCA($id_annee){
        return $this->createQueryBuilder('f')
            ->select('f.year, SUM(f.total_vente) as ca')
            ->groupBy('f.year')
            ->where('f.year = :id_year')
            ->setParameter('id_year', $id_annee)
            ->getQuery()
            ->getResult();
    }

    public function getCommercialFirst($id_annee){
        return $this->createQueryBuilder('f')
            ->select('f.year')
            ->addSelect('c.nom')
            ->addSelect('SUM(f.total_vente) as chiffre')
            ->where('f.year = :id_year')
            ->setParameter('id_year', $id_annee)
            ->innerJoin('App\\Entity\\DimensionCommercial', 'c')
            ->andWhere('c.id = f.groupe_vendeur')
            ->groupBy('f.groupe_vendeur')
            ->orderBy('SUM(f.total_vente)','DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }
    public function getTopFiveCommercial($id_annee){
        /*return $this->createQueryBuilder('f')
            ->select('f.year, f.groupe_vendeur, SUM(f.total_vente) as chiffre')//c.nom
            ->where('f.year = :id_year')
            ->setParameter('id_year', $id_annee)
            ->innerJoin('f', 'groupeVendeur', 'c', 'f.groupeVendeur = c.id')
            //->innerJoin('f.groupeVendeur','c')
            ->groupBy('f.groupe_vendeur')
            ->orderBy('SUM(f.total_vente)','DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();*/
        return $this->createQueryBuilder('f')
            ->select('f.year')
            ->addSelect('c.nom')
            ->addSelect('SUM(f.total_vente) as chiffre')
            ->where('f.year = :id_year')
            ->setParameter('id_year', $id_annee)
            ->innerJoin('App\\Entity\\DimensionCommercial', 'c')
            ->andWhere('c.id = f.groupe_vendeur')
            ->groupBy('f.groupe_vendeur')
            ->orderBy('SUM(f.total_vente)','DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
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
