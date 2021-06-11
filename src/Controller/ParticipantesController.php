<?php

namespace App\Controller;

use App\Entity\Participantes;
use App\Form\ParticipantesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/participantes")
 */
class ParticipantesController extends AbstractController
{
    /**
     * @Route("/", name="participantes_index", methods={"GET"})
     */
    public function index(): Response
    {
        $participantes = $this->getDoctrine()
            ->getRepository(Participantes::class)
            ->findAll();

        return $this->render('participantes/index.html.twig', [
            'participantes' => $participantes,
        ]);
    }

    /**
     * @Route("/new", name="participantes_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $participante = new Participantes();
        $form = $this->createForm(ParticipantesType::class, $participante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($participante);
            $entityManager->flush();

            return $this->redirectToRoute('participantes_index');
        }

        return $this->render('participantes/new.html.twig', [
            'participante' => $participante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="participantes_show", methods={"GET"})
     */
    public function show(Participantes $participante): Response
    {
        return $this->render('participantes/show.html.twig', [
            'participante' => $participante,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="participantes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Participantes $participante): Response
    {
        $form = $this->createForm(ParticipantesType::class, $participante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('participantes_index');
        }

        return $this->render('participantes/edit.html.twig', [
            'participante' => $participante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="participantes_delete", methods={"POST"})
     */
    public function delete(Request $request, Participantes $participante): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participante->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($participante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('participantes_index');
    }
}
