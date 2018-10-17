<?php

namespace App\Controller;

use App\Entity\Pharmacien;
use App\Form\PharmacienType;
use App\Repository\PharmacienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pharmacien")
 */
class PharmacienController extends AbstractController
{
    /**
     * @Route("/", name="pharmacien_index", methods="GET")
     */
    public function index(PharmacienRepository $pharmacienRepository): Response
    {
        return $this->render('pharmacien/index.html.twig', ['pharmaciens' => $pharmacienRepository->findAll()]);
    }

    /**
     * @Route("/new", name="pharmacien_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $pharmacien = new Pharmacien();
        $form = $this->createForm(PharmacienType::class, $pharmacien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pharmacien);
            $em->flush();

            return $this->redirectToRoute('pharmacien_index');
        }

        return $this->render('pharmacien/new.html.twig', [
            'pharmacien' => $pharmacien,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pharmacien_show", methods="GET")
     */
    public function show(Pharmacien $pharmacien): Response
    {
        return $this->render('pharmacien/show.html.twig', ['pharmacien' => $pharmacien]);
    }

    /**
     * @Route("/{id}/edit", name="pharmacien_edit", methods="GET|POST")
     */
    public function edit(Request $request, Pharmacien $pharmacien): Response
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
    public function delete(Request $request, Pharmacien $pharmacien): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pharmacien->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pharmacien);
            $em->flush();
        }

        return $this->redirectToRoute('pharmacien_index');
    }
}
