<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class KpiGenerauxController extends AbstractController
{
    /**
     * @Route("/kpi/generaux", name="kpi_generaux")
     */
    public function index()
    {
        return $this->render('kpi_generaux/index.html.twig', [
            'controller_name' => 'KpiGenerauxController',
        ]);
    }
}
