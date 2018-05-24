<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PresidenteController extends Controller
{
    /**
     * @Route("/presidente", name="presidente")
     */
    public function index()
    {
        return $this->render('presidente/index.html.twig', [
            'controller_name' => 'PresidenteController',
        ]);
    }
}
