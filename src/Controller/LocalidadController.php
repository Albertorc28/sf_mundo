<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LocalidadController extends Controller
{
    /**
     * @Route("/localidad", name="localidad")
     */
    public function index()
    {
        return $this->render('localidad/index.html.twig', [
            'controller_name' => 'LocalidadController',
        ]);
    }
}
