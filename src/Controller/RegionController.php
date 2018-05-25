<?php

namespace App\Controller;

use App\Entity\Region;
use App\Form\RegionType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
* @Route("/region")
*/
class RegionController extends Controller
{
    /**
    * @Route("", name="region_lista")
    */
    public function lista(Request $request)
   	{
        $repo = $this->getDoctrine()->getRepository(Region::class);
        $regiones = $repo->findAll();        
        return $this->render('region/index.html.twig', [
        'listaregion' => $regiones     
       ]);
   	}

   	/**
    * @Route("/nuevo", name="region_nuevo")
    */
    public function index(Request $request)
    {
      $region = new Region();
      $formu = $this->createForm(RegionType::class, $region);
      $formu->handleRequest($request);

      if ($formu->isSubmitted()){
        dump($region);
            $em = $this->getDoctrine()->getManager();
            $em->persist($region);
            $em->flush();

            return $this->redirectToRoute('pais_detalle', array('id' => $region->getPais()->getId()));
        
      }
        return $this->render('region/nuevo.html.twig', [
            'formulario' => $formu->createView(),
        ]);
    }

}
