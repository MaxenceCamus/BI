<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        if($this->getUser()){
            return $this->redirectToRoute('kpi_generaux');
        }
        return $this->render('index/index.html.twig');
    }
}
