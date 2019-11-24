<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class KpiCommerciauxController extends AbstractController
{
    /**
     * @Route("/kpi/commerciaux", name="kpi_commerciaux")
     */
    public function index()
    {
        return $this->render('kpi_commerciaux/index.html.twig', [
            'controller_name' => 'KpiCommerciauxController',
        ]);
    }
}
