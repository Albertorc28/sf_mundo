<?php

namespace App\Controller;

use App\Entity\Presidente;
use App\Form\PresidenteType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
* @Route("/presidente")
*/
class PresidenteController extends Controller
{
    /**
    * @Route("", name="presidente_lista")
    */
    public function lista(Request $request)
   	{
        $repo = $this->getDoctrine()->getRepository(Presidente::class);
        $presidentes = $repo->findAll();        
        return $this->render('presidente/index.html.twig', [
        'listapresidente' => $presidentes     
       ]);
   	}

   	/**
    * @Route("/nuevo", name="presidente_nuevo")
    */
    public function index(Request $request)
    {
      $presidente = new Presidente();
      $formu = $this->createForm(PresidenteType::class, $presidente);
      $formu->handleRequest($request);

      if ($formu->isSubmitted()){
        dump($presidente);
            $em = $this->getDoctrine()->getManager();
            $em->persist($presidente);
            $em->flush();

            return $this->redirectToRoute('pais_detalle', array('id' => $presidente->getPais()->getId()));

        
      }
        return $this->render('presidente/nuevo.html.twig', [
            'formulario' => $formu->createView(),
        ]);
    }
}
