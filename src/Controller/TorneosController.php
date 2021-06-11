<?php

namespace App\Controller;

use App\Entity\Torneos;
use App\Form\TorneosType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/torneos")
 */
class TorneosController extends AbstractController
{
    /**
     * @Route("/", name="torneos_index", methods={"GET"})
     */
    public function index(): Response
    {
        $torneos = $this->getDoctrine()
            ->getRepository(Torneos::class)
            ->findAll();

        return $this->render('torneos/index.html.twig', [
            'torneos' => $torneos,
        ]);
    }

    /**
     * @Route("/new", name="torneos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $torneo = new Torneos();
        $form = $this->createForm(TorneosType::class, $torneo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($torneo);
            $entityManager->flush();

            return $this->redirectToRoute('torneos_index');
        }

        return $this->render('torneos/new.html.twig', [
            'torneo' => $torneo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="torneos_show", methods={"GET"})
     */
    public function show(Torneos $torneo): Response
    {
        return $this->render('torneos/show.html.twig', [
            'torneo' => $torneo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="torneos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Torneos $torneo): Response
    {
        $form = $this->createForm(TorneosType::class, $torneo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('torneos_index');
        }

        return $this->render('torneos/edit.html.twig', [
            'torneo' => $torneo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="torneos_delete", methods={"POST"})
     */
    public function delete(Request $request, Torneos $torneo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$torneo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($torneo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('torneos_index');
    }
}
