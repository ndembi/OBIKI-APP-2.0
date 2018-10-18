<?php

namespace App\Controller;

use App\Entity\Pharmacien;
use App\Form\PharmacienType;
use App\Repository\PharmacienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pharmacien")
 */
class PharmacienController extends Controller
{
    /**
     * @Route("/", name="pharmacien_index", methods="GET")
     */
    public function indexPharmacienAction(PharmacienRepository $pharmacienRepository): Response
    {
        $serializer = $this->get('jms_serializer');
        $data = $serializer->serialize($pharmacienRepository->findAll(), 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }

    /**
     * @Route("/new", name="pharmacien_new", methods="POST")
     */
    public function newPharmacienAction(Request $request): Response
    {
        try {
            //On recupère les données depuis le formulaire
            $data = $request->getContent();
            //On les décodent
            $pharmacien = $this->get('jms_serializer')->deserialize($data, 'App\Entity\Pharmacien', 'json');
            //On insert les infos dans la database
            $em = $this->getDoctrine()->getManager();
            $em->persist($pharmacien);
            $em->flush();
            return new Response('', Response::HTTP_CREATED);
        } catch (Excepttion $e) {
            echo 'Exception reçue  : ',  $e->getMessage(), "\n";
        }

    }

    /**
     * @Route("/{id}", name="pharmacien_show", methods="GET")
     */
    public function showPharmacienAction(Pharmacien $pharmacien): Response
    {
        $serializer = $this->get('jms_serializer');
        $data = $serializer->serialize($pharmacien, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/{id}/edit", name="pharmacien_edit", methods="GET|POST")
     */
    public function editPharmacienAction(Request $request, Pharmacien $pharmacien): Response
    {
        $form = $this->createForm(PharmacienType::class, $pharmacien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pharmacien_edit', ['id' => $pharmacien->getId()]);
        }

        return $this->render('pharmacien/edit.html.twig', [
            'pharmacien' => $pharmacien,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pharmacien_delete", methods="DELETE")
     */
    public function deletePharmacienAction(Pharmacien $pharmacien): Response
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pharmacien);
            $em->flush();
            return new Response("delete succès", Response::HTTP_ACCEPTED);

    }
}
