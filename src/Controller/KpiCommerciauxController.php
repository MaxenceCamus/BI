<?php

namespace App\Controller;

use App\Entity\DimensionCommercial;
use App\Entity\DimensionOffreCommande;
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
     * @Route("/kpi/commerciaux/{id}/", name="kpi_commerciaux_by_id")
     */
    public function commercial($id)
    {
        $commerciaux = $this->getDoctrine()->getRepository(DimensionCommercial::class)->findBy([], ['nom' => 'ASC']);
        $commercial = $this->getDoctrine()->getRepository(DimensionCommercial::class)->find($id);

        $perfsPerYear = $this->getDoctrine()->getRepository(FaitPerfCom::class)->getPerfVendeurByYear($commercial->getId());

        $offres = $this->getDoctrine()->getRepository(DimensionOffreCommande::class)->findBy(['groupe_vendeur' => $commercial->getId()]);
        $commandes = $this->getDoctrine()->getRepository(DimensionOffreCommande::class)->findBy(['groupe_vendeur' => $commercial->getId(), 'prb' => '100']);

        dump(count($offres));
        dump(count($commandes));

        $taux_trans = (count($commandes) * 100 ) / count($offres);


        return $this->render('kpi_commerciaux/index.html.twig', [
            'commerciaux' => $commerciaux,
            'commercial' => $commercial,
            'perfsPerYear' => $perfsPerYear,
            'taux_trans' => $taux_trans
        ]);
    }
}
