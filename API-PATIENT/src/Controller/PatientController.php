<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\PatientType;
use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/patient")
 */
class PatientController extends Controller
{
    /**
     * @Route("/", name="patient_index", methods="GET")
     */
    public function indexPatientAction(PatientRepository $patientRepository): Response
    {
        $serializer = $this->get('jms_serializer');
        $data = $serializer->serialize($patientRepository->findAll(), 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/new", name="patient_new", methods="POST")
     */
    public function newPatientAction(Request $request): Response
    {
         try {
            //On recupère les données depuis le formulaire
            $data = $request->getContent();
            //On les décodent
            $patient = $this->get('jms_serializer')->deserialize($data, 'App\Entity\Patient', 'json');
            //On insert les infos dans la database
            $em = $this->getDoctrine()->getManager();
            $em->persist($patient);
            $em->flush();
            return new Response('', Response::HTTP_CREATED);
        } catch (Excepttion $e) {
                echo 'Exception reçue  : ',  $e->getMessage(), "\n";
        }

    }

    /**
     * @Route("/{id}", name="patient_show", methods="GET")
     */
    public function showPatientAction(Patient $patient): Response
    {
        $serializer = $this->get('jms_serializer');
        $data = $serializer->serialize($patient, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }

    /**
     * @Route("/{id}/edit", name="patient_edit", methods="GET|POST")
     */
    public function editPatientAction(Request $request, Patient $patient): Response
    {
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('patient_edit', ['id' => $patient->getId()]);
        }

        return $this->render('patient/edit.html.twig', [
            'patient' => $patient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="patient_delete", methods="DELETE")
     */
    public function deletePatientAction(Patient $patient): Response
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($patient);
            $em->flush();
            return new Response("delete succès", Response::HTTP_ACCEPTED);

    }
}
