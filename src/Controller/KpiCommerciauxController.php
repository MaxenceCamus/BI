<?php

namespace App\Controller;

use App\Entity\DimensionCommercial;
use App\Entity\DimensionOffreCommande;
use App\Entity\DimensionTemps;
use App\Entity\FaitPerfCom;
use ContainerAuDTsQF\srcApp_KernelDevDebugContainer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class KpiCommerciauxController extends AbstractController
{
    /**
     * @Route("/kpi/commerciaux", name="kpi_commerciaux")
     */
    public function index()
    {
        $commercial = $this->getDoctrine()->getRepository(DimensionCommercial::class)->findBy([], ['nom' => 'ASC'], [1]);
        return $this->redirectToRoute('kpi_commerciaux_by_id', [
            'id' => $commercial[0]->getId()
        ]);
    }

    /**
     * @Route("/kpi/commerciaux/{id}/{year}/{month}/",
     *     name="kpi_commerciaux_by_id",
     *     defaults={"year"="all", "month"="all"}
     *     )
     */
    public function commercial($id, $year = null, $month = null)
    {
        if($year == 'all'){
            $year = null;
        }
        if($month == 'all'){
            $month = null;
        }

        $yearsList = $this->getDoctrine()->getRepository(DimensionTemps::class)->yearDistinct();
        $monthList = $this->getDoctrine()->getRepository(DimensionTemps::class)->monthDistinct();

        $commerciaux = $this->getDoctrine()->getRepository(DimensionCommercial::class)->findBy([], ['nom' => 'ASC']);
        $commercial = $this->getDoctrine()->getRepository(DimensionCommercial::class)->find($id);

        $perfsPerYear = $this->getDoctrine()->getRepository(FaitPerfCom::class)->getPerfVendeurByYear($commercial->getId());

        $taux_trans = $this->getDoctrine()->getRepository(DimensionOffreCommande::class)->getTauxConversion($commercial->getId(), $year, $month);
        $nb_ventes = $this->getDoctrine()->getRepository(DimensionOffreCommande::class)->getNombreVentes($commercial->getId(), $year, $month);
        $total_ventes = $this->getDoctrine()->getRepository(DimensionOffreCommande::class)->getTotalVentes($commercial->getId(), $year, $month);
        $meilleure_vente = $this->getDoctrine()->getRepository(DimensionOffreCommande::class)->getMeilleureVente($commercial->getId(), $year, $month);


        return $this->render('kpi_commerciaux/index.html.twig', [
            'commerciaux' => $commerciaux,
            'commercial' => $commercial,
            'month' => $month,
            'year' => $year,
            'perfsPerYear' => $perfsPerYear,
            'taux_trans' => $taux_trans,
            'nbVentes' => $nb_ventes,
            'totalVentes' => $total_ventes,
            'yearList' => $yearsList,
            'monthList' => $monthList,
            'meilleureVente' => $meilleure_vente
        ]);
    }
}
