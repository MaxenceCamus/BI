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

    public function getNombreVentes($id_commercial, $year=null, $month = null){
        $nombre_commandes_query = $this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->andWhere('o.groupe_vendeur = :id_commercial')
            ->andWhere("o.typeDC = 'C'")
            ->setParameter('id_commercial', $id_commercial);

        if($year !== null){
            $nombre_commandes_query->andWhere("o.year = :year")
                ->setParameter('year', $year);
        }
        if($month !== null){
            $nombre_commandes_query->andWhere("o.month = :month")
                ->setParameter('month', $month);
        }
        return $nombre_commandes_query->getQuery()->getSingleScalarResult();
    }

    public function getTotalVentes($id_commercial, $year=null, $month = null){
        $total_commande_query = $this->createQueryBuilder('o')
            ->select('SUM(o.valeur_nette)')
            ->andWhere('o.groupe_vendeur = :id_commercial')
            ->andWhere("o.typeDC = 'C'")
            ->setParameter('id_commercial', $id_commercial);

        if($year !== null){
            $total_commande_query->andWhere("o.year = :year")
                ->setParameter('year', $year);
        }
        if($month !== null){
            $total_commande_query->andWhere("o.month = :month")
                ->setParameter('month', $month);
        }
        return $total_commande_query->getQuery()->getSingleScalarResult();
    }

    public function getMeilleureVente($id_commercial, $year=null, $month = null){
        $total_commande_query = $this->createQueryBuilder('o')
            ->select('MAX(o.valeur_nette)')
            ->andWhere('o.groupe_vendeur = :id_commercial')
            ->andWhere("o.typeDC = 'C'")
            ->setParameter('id_commercial', $id_commercial);

        if($year !== null){
            $total_commande_query->andWhere("o.year = :year")
                ->setParameter('year', $year);
        }
        if($month !== null){
            $total_commande_query->andWhere("o.month = :month")
                ->setParameter('month', $month);
        }
        return $total_commande_query->getQuery()->getSingleScalarResult();
    }

    public function getTauxConversion($id_commercial, $year = null, $month = null){
        $nombre_offres_query = $this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->where('o.groupe_vendeur = :id_commercial')
            ->setParameter('id_commercial', $id_commercial);

        if($year !== null){
            $nombre_offres_query->andWhere("o.year = :year")
                ->setParameter('year', $year);
        }
        if($month !== null){
            $nombre_offres_query->andWhere("o.month = :month")
                ->setParameter('month', $month);
        }
        $nombre_offres = $nombre_offres_query->getQuery()->getSingleScalarResult();

        $nombre_commandes_query = $this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->andWhere('o.groupe_vendeur = :id_commercial')
            ->andWhere("o.typeDC = 'C'")
            ->setParameter('id_commercial', $id_commercial);

        if($year !== null){
            $nombre_commandes_query->andWhere("o.year = :year")
                ->setParameter('year', $year);
        }
        if($month !== null){
            $nombre_commandes_query->andWhere("o.month = :month")
                ->setParameter('month', $month);
        }
        $nombre_commandes = $nombre_commandes_query->getQuery()->getSingleScalarResult();

        if($nombre_offres > 0){
            return ($nombre_commandes * 100 ) / $nombre_offres;
        }else{
            return 0;
        }

    }

    public function getNombreDevisByMonth($id_commercial, $year = null, $month = null){
        $nombre_devis_query = $this->createQueryBuilder('o')
            ->select('COUNT(o.id) as nombre_devis, o.month')
            ->andWhere('o.groupe_vendeur = :id_commercial')
            ->groupBy('o.month')
            ->orderBy('o.month', 'ASC')
            ->setParameter('id_commercial', $id_commercial);

        if($year !== null){
            $nombre_devis_query->andWhere("o.year = :year")
                ->setParameter('year', $year);
        }
        return $nombre_devis_query->getQuery()->getResult();
    }

    public function getNombreVenteByMonth($id_commercial, $year = null){
        $nombre_vente_query = $this->createQueryBuilder('o')
            ->select('COUNT(o.id) as nombre_vente, o.month')
            ->andWhere('o.groupe_vendeur = :id_commercial')
            ->andWhere("o.typeDC = 'C'")
            ->groupBy('o.month')
            ->orderBy('o.month', 'ASC')
            ->setParameter('id_commercial', $id_commercial);

        if($year !== null){
            $nombre_vente_query->andWhere("o.year = :year")
                ->setParameter('year', $year);
        }
        return $nombre_vente_query->getQuery()->getResult();
    }

}
