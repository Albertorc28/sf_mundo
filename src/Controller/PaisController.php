<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PaisController extends Controller
{
    /**
     * @Route("/pais", name="pais")
     */
    public function index()
    {
        return $this->render('pais/index.html.twig', [
            'controller_name' => 'PaisController',
        ]);
    }
}
