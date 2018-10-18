<?php

namespace App\Controller;

use App\Entity\Pharmacie;
use App\Form\PharmacieType;
use App\Repository\PharmacieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/pharmacie")
 */
class PharmacieController extends Controller
{
    /**
     * @Route("/", name="pharmacie_index", methods="GET")
     */
    public function indexPharmacieAction(PharmacieRepository $pharmacieRepository): Response
    {
         $serializer = $this->get('jms_serializer');
        $data = $serializer->serialize($pharmacieRepository->findAll(), 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/new", name="pharmacie_new", methods="POST")
     */
    public function newPharmacieAction(Request $request): Response
    {
        try {
        //On recupère les données depuis le formulaire
        $data = $request->getContent();
        //On les décodent
        $pharmacie = $this->get('jms_serializer')->deserialize($data, 'App\Entity\Pharmacie', 'json');
        //On insert les infos dans la database
        $em = $this->getDoctrine()->getManager();
        $em->persist($pharmacie);
        $em->flush();
                return new Response('', Response::HTTP_CREATED);
        } catch (Excepttion $e) {
            echo 'Exception reçue  : ',  $e->getMessage(), "\n";
        }

    }

    /**
     * @Route("/{id}", name="pharmacie_show", methods="GET")
     */
    public function showPharmacieAction(Pharmacie $pharmacie): Response
    {
        $serializer = $this->get('jms_serializer');
        $data = $serializer->serialize($pharmacie, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }

    /**
     * @Route("/{id}/edit", name="pharmacie_edit", methods="GET|POST")
     */
    public function editPharmacieAction(Request $request, Pharmacie $pharmacie): Response
    {
        $form = $this->createForm(PharmacieType::class, $pharmacie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pharmacie_edit', ['id' => $pharmacie->getId()]);
        }

        return $this->render('pharmacie/edit.html.twig', [
            'pharmacie' => $pharmacie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pharmacie_delete", methods="DELETE")
     */
    public function deletePharmacieAction(Pharmacie $pharmacie): Response
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pharmacie);
            $em->flush();
            return new Response("delete succès", Response::HTTP_ACCEPTED);

    }
}
