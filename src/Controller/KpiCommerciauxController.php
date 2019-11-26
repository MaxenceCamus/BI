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

        return $this->render('kpi_commerciaux/index.html.twig', [
            'commerciaux' => $commerciaux,
            'commercial' => $commercial
        ]);
    }
}
