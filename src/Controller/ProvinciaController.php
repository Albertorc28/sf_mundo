<?php

namespace App\Controller;

use App\Entity\Provincia;
use App\Form\ProvinciaType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
* @Route("/provincia")
*/
class ProvinciaController extends Controller
{
    /**
    * @Route("", name="provincia_lista")
    */
    public function lista(Request $request)
   	{
        $repo = $this->getDoctrine()->getRepository(Provincia::class);
        $provincias = $repo->findAll();        
        return $this->render('provincia/index.html.twig', [
        'listaprovincia' => $provincias      
       ]);
   }

    /**
    * @Route("/nuevo", name="provincia_nuevo")
    */
    public function index(Request $request)
    {
      $provincia = new Provincia();
      $formu = $this->createForm(ProvinciaType::class, $provincia);
      $formu->handleRequest($request);

      if ($formu->isSubmitted()){
        dump($provincia);
            $em = $this->getDoctrine()->getManager();
            $em->persist($provincia);
            $em->flush();

            return $this->redirectToRoute('pais_detalle', array('id' => $provincia->getRegion()->getPais()->getId()));
        
      }
        return $this->render('provincia/nuevo.html.twig', [
            'formulario' => $formu->createView(),
        ]);
    }
}
