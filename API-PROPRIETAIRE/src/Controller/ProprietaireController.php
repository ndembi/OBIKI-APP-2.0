<?php

namespace App\Controller;

use App\Entity\Proprietaire;
use App\Form\ProprietaireType;
use App\Repository\ProprietaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/proprietaire")
 */
class ProprietaireController extends AbstractController
{
    /**
     * @Route("/", name="proprietaire_index", methods="GET")
     */
    public function index(ProprietaireRepository $proprietaireRepository): Response
    {
        return $this->render('proprietaire/index.html.twig', ['proprietaires' => $proprietaireRepository->findAll()]);
    }

    /**
     * @Route("/new", name="proprietaire_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $proprietaire = new Proprietaire();
        $form = $this->createForm(ProprietaireType::class, $proprietaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($proprietaire);
            $em->flush();

            return $this->redirectToRoute('proprietaire_index');
        }

        return $this->render('proprietaire/new.html.twig', [
            'proprietaire' => $proprietaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="proprietaire_show", methods="GET")
     */
    public function show(Proprietaire $proprietaire): Response
    {
        return $this->render('proprietaire/show.html.twig', ['proprietaire' => $proprietaire]);
    }

    /**
     * @Route("/{id}/edit", name="proprietaire_edit", methods="GET|POST")
     */
    public function edit(Request $request, Proprietaire $proprietaire): Response
    {
        $form = $this->createForm(ProprietaireType::class, $proprietaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('proprietaire_edit', ['id' => $proprietaire->getId()]);
        }

        return $this->render('proprietaire/edit.html.twig', [
            'proprietaire' => $proprietaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="proprietaire_delete", methods="DELETE")
     */
    public function delete(Request $request, Proprietaire $proprietaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$proprietaire->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($proprietaire);
            $em->flush();
        }

        return $this->redirectToRoute('proprietaire_index');
    }
}
