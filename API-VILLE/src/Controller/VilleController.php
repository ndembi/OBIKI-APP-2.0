<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Form\VilleType;
use App\Repository\VilleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/ville")
 */
class VilleController extends Controller
{
    /**
     * @Route("/", name="ville_index", methods="GET")
     */
    public function indexVilleAction(VilleRepository $villeRepository): Response
    {
        $serializer = $this->get('jms_serializer');
        $data = $serializer->serialize($villeRepository->findAll(), 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }

    /**
     * @Route("/new", name="ville_new", methods="POST")
     */
    public function newVilleAction(Request $request): Response
    {
        try{
            //On recupère les données depuis le formulaire
            $data = $request->getContent();
            //On les décodent
            $ville = $this->get('jms_serializer')->deserialize($data, 'App\Entity\Ville', 'json');
            //On insert les infos dans la database
            $em = $this->getDoctrine()->getManager();
            $em->persist($ville);
            $em->flush();
            return new Response('', Response::HTTP_CREATED);

        }catch(Excepttion $e){
            echo 'Exception reçue  : ',  $e->getMessage(), "\n";
        }

    }

    /**
     * @Route("/{id}", name="ville_show", methods="GET")
     */
    public function showVilleAction(Ville $ville): Response
    {
        $serializer = $this->get('jms_serializer');
        $data = $serializer->serialize($ville, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/{id}/edit", name="ville_edit", methods="GET|POST")
     */
    public function editVilleAction(Request $request, Ville $ville): Response
    {
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ville_edit', ['id' => $ville->getId()]);
        }

        return $this->render('ville/edit.html.twig', [
            'ville' => $ville,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ville_delete", methods="DELETE")
     */
    public function deleteVilleAction(Ville $ville): Response
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ville);
            $em->flush();
            return new Response("delete succès",Response::HTTP_ACCEPTED);
    }
}
