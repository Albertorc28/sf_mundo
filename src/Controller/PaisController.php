<?php

namespace App\Controller;

use App\Entity\Pais;
use App\Form\PaisType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
* @Route("/pais")
*/
class PaisController extends Controller
{
    /**
    * @Route("", name="pais_lista")
    */
    public function lista(Request $request)
   	{
        $repo = $this->getDoctrine()->getRepository(Pais::class);
        $paises = $repo->findAll();        
        return $this->render('pais/index.html.twig', [
        'listapais' => $paises     
       ]);
   	}

   	/**
    * @Route("/nuevo", name="pais_nuevo")
    */
    public function index(Request $request)
    {
      $pais = new Pais();
      $formu = $this->createForm(PaisType::class, $pais);
      $formu->handleRequest($request);

      if ($formu->isSubmitted()){
        dump($pais);
            $em = $this->getDoctrine()->getManager();
            $em->persist($pais);
            $em->flush();

            return $this->redirectToRoute('pais_detalle', array('id' => $pais->getId()));    
    }
    
        return $this->render('pais/nuevo.html.twig', [
            'formulario' => $formu->createView(),
        ]);
    }

    /**
    * @Route("/detalle/{id}", name="pais_detalle", requirements={"id"="\d+"})
    */
    public function detalle($id)
   	{
            $repo = $this->getDoctrine()->getRepository(Pais::class);
            $pais = $repo->find($id);
            dump($pais);          
            return $this->render('pais/detalle.html.twig', [      
            'pais' => $pais      
            ]);
   	}
}
