<?php

namespace App\Controller;

use App\Entity\Pharmacie;
use App\Form\PharmacieType;
use App\Repository\PharmacieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pharmacie")
 */
class PharmacieController extends AbstractController
{
    /**
     * @Route("/", name="pharmacie_index", methods="GET")
     */
    public function index(PharmacieRepository $pharmacieRepository): Response
    {
        return $this->render('pharmacie/index.html.twig', ['pharmacies' => $pharmacieRepository->findAll()]);
    }

    /**
     * @Route("/new", name="pharmacie_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $pharmacie = new Pharmacie();
        $form = $this->createForm(PharmacieType::class, $pharmacie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pharmacie);
            $em->flush();

            return $this->redirectToRoute('pharmacie_index');
        }

        return $this->render('pharmacie/new.html.twig', [
            'pharmacie' => $pharmacie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pharmacie_show", methods="GET")
     */
    public function show(Pharmacie $pharmacie): Response
    {
        return $this->render('pharmacie/show.html.twig', ['pharmacie' => $pharmacie]);
    }

    /**
     * @Route("/{id}/edit", name="pharmacie_edit", methods="GET|POST")
     */
    public function edit(Request $request, Pharmacie $pharmacie): Response
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
    public function delete(Request $request, Pharmacie $pharmacie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pharmacie->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pharmacie);
            $em->flush();
        }

        return $this->redirectToRoute('pharmacie_index');
    }
}
