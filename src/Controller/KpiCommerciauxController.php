<?php

namespace App\Controller;

use App\Entity\DimensionCommercial;
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
        $commerciaux = $this->getDoctrine()->getRepository(DimensionCommercial::class)->findAll();
        return $this->render('kpi_commerciaux/index.html.twig', [
            'commerciaux' => $commerciaux
        ]);
    }

    /**
     * @Route("/kpi/commerciaux/{id}/", name="kpi_commerciaux_by_id")
     */
    public function commercial($id)
    {
        $commerciaux = $this->getDoctrine()->getRepository(DimensionCommercial::class)->findAll();
        $commercial = $this->getDoctrine()->getRepository(DimensionCommercial::class)->find($id);

        return $this->render('kpi_commerciaux/index.html.twig', [
            'commerciaux' => $commerciaux
        ]);
    }

    /**
     * @param $id
     * @Route("/ajax/kpi/commerciaux/get-single-commercial", name="get_commercial_stats")
     */
    public function getCommercialStats(Request $request){
        if ($request->isXmlHttpRequest()){
            return $this->render('kpi_commerciaux/stats_single.html.twig');
        }else{
            throw new BadRequestHttpException();
        }
    }
}
