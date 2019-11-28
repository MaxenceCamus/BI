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
     * @Route("/kpi/commerciaux/{id}/{year}/",
     *     name="kpi_commerciaux_by_id",
     *     defaults={"year"="all"}
     *     )
     */
    public function commercial($id, $year = null)
    {
        $month = null;

        if($year == 'all'){
            $year = null;
        }

        $yearsList = $this->getDoctrine()->getRepository(DimensionTemps::class)->yearDistinct();
        $monthList = $this->getDoctrine()->getRepository(DimensionTemps::class)->monthDistinct();

        $commerciaux = $this->getDoctrine()->getRepository(DimensionCommercial::class)->findBy([], ['nom' => 'ASC']);
        $commercial = $this->getDoctrine()->getRepository(DimensionCommercial::class)->find($id);

        $perfsPerYear = $this->getDoctrine()->getRepository(FaitPerfCom::class)->getPerfVendeurByYear($commercial->getId());

            $taux_trans = $this->getDoctrine()->getRepository(DimensionOffreCommande::class)->getTauxConversion($commercial->getId(), $year, $month);

        $nb_devis_month = $this->getDoctrine()->getRepository(DimensionOffreCommande::class)->getNombreDevisByMonth($commercial->getId(), $year);
        $nb_vente_month = $this->getDoctrine()->getRepository(DimensionOffreCommande::class)->getNombreVenteByMonth($commercial->getId(), $year);

        $nb_ventes = $this->getDoctrine()->getRepository(DimensionOffreCommande::class)->getNombreVentes($commercial->getId(), $year, $month);

        $total_ventes = $this->getDoctrine()->getRepository(DimensionOffreCommande::class)->getTotalVentes($commercial->getId(), $year, $month);

        $meilleure_vente = $this->getDoctrine()->getRepository(DimensionOffreCommande::class)->getMeilleureVente($commercial->getId(), $year, $month);

        $total_ventes_by_month = $this->getDoctrine()->getRepository(FaitPerfCom::class)->getTotalVentesByMonth($commercial->getId(), $year, $month);

        $array_evolution_vente = [];
        $t = 0;
        foreach ($total_ventes_by_month as $tvmonth){
            $y = intval($tvmonth['year']);
            $m = intval($tvmonth['month']);
            $t += intval($tvmonth['total_vente']);

            if(!isset($array_evolution_vente[$y])){
                $array_evolution_vente[$y] = [];
            }
            $array_evolution_vente[$y][$m] = $t;
        }

        foreach ($array_evolution_vente as $key=>$aev){
            for ($i = 1; $i <= 12; $i++){
                if(!isset($aev[$i])){
                    $aev[$i] = 0;
                }
            }
            ksort($aev);
            $array_evolution_vente[$key] = $aev;
        }

        $lastval = 0;
        foreach ($array_evolution_vente as $key=>$aev){
            for ($i = 1; $i <= 12; $i++){
                if(!isset($aev[$i])){
                    $aev[$i] = 0;
                }
            }
            ksort($aev);
            $array_evolution_vente[$key] = $aev;
        }
        $array_final = [];

        foreach ($array_evolution_vente as $key=>$aev){
            for ($i = 1; $i <= 12; $i++){
                if($aev[$i] == 0){
                    $aev[$i] = $lastval;
                }else{
                    $lastval = $aev[$i];
                }
            }
            $array_final[$key] = $aev;
            $array_evolution_vente[$key] = $aev;
        }

        if($nb_ventes > 0){
            $vente_moyenne = $total_ventes / $nb_ventes;
        }else{
            $vente_moyenne = 0;
        }

        $array_devis_month = [];
        $array_vente_month = [];

        foreach ($nb_devis_month as $nbdm){
            $array_devis_month[intval($nbdm['month'])] = intval($nbdm['nombre_devis']);
        }

        foreach ($nb_vente_month as $nbvm){
            $array_vente_month[intval($nbvm['month'])] = intval($nbvm['nombre_vente']);
        }

        for ($i = 1; $i <= 12; $i++){
            if(!isset($array_devis_month[$i])){
                $array_devis_month[$i] = 0;
            }
        }

        for ($i = 1; $i <= 12; $i++){
            if(!isset($array_vente_month[$i])){
                $array_vente_month[$i] = 0;
            }
        }

        ksort($array_devis_month);
        ksort($array_vente_month);

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
            'meilleureVente' => $meilleure_vente,
            'venteMoyenne' => $vente_moyenne,
            'devisMonth' => $array_devis_month,
            'ventesMonth' => $array_vente_month,
            'evolutionVentes' => $array_evolution_vente
        ]);
    }
}
