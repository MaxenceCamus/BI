<?php

namespace App\Controller;

use App\Entity\DimensionCommercial;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
