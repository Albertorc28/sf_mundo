<?php

namespace App\Controller;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Localidad;
use App\Form\LocalidadType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
* @Route("/localidad")
*/
class LocalidadController extends Controller
{
    /**
     * @Route("", name="localidad_lista")
     */
    public function lista(Request $request)
   	{
        $repo = $this->getDoctrine()->getRepository(Localidad::class);
        $localidades = $repo->findAll();        
        return $this->render('localidad/index.html.twig', [
        'listalocalidad' => $localidades      
       ]);
   }

    /**
    * @Route("/nuevo", name="localidad_nuevo")
    */
    public function index(Request $request)
    {
      $localidad = new Localidad();
      $formu = $this->createForm(LocalidadType::class, $localidad);
      $formu->handleRequest($request);

      if ($formu->isSubmitted()){
        dump($localidad);
            $em = $this->getDoctrine()->getManager();
            $em->persist($localidad);
            $em->flush();

            return $this->redirectToRoute('pais_detalle', array('id' => $localidad->getProvincia()->getRegion()->getPais()->getId()));
        
      }
        return $this->render('localidad/nuevo.html.twig', [
            'formulario' => $formu->createView(),
        ]);
    }
    
}
