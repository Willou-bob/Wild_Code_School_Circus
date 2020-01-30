<?php

namespace App\Controller;

use App\Entity\Spectacle;
use App\Form\SpectacleType;
use App\Repository\SpectacleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/adminSpectacle")
 */
class SpectacleController extends AbstractController
{
    /**
     * @Route("/", name="spectacle_index", methods={"GET"})
     */
    public function index(SpectacleRepository $spectacleRepository): Response
    {
        return $this->render('adminSpectacle/index.html.twig', [
            'spectacles' => $spectacleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="spectacle_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $spectacle = new Spectacle();
        $form = $this->createForm(SpectacleType::class, $spectacle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($spectacle);
            $entityManager->flush();

            return $this->redirectToRoute('spectacle_index');
        }

        return $this->render('adminSpectacle/new.html.twig', [
            'adminSpectacle' => $spectacle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="spectacle_show", methods={"GET"})
     */
    public function show(Spectacle $spectacle): Response
    {
        return $this->render('adminSpectacle/show.html.twig', [
            'adminSpectacle' => $spectacle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="spectacle_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Spectacle $spectacle): Response
    {
        $form = $this->createForm(SpectacleType::class, $spectacle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('spectacle_index');
        }

        return $this->render('adminSpectacle/edit.html.twig', [
            'adminSpectacle' => $spectacle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="spectacle_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Spectacle $spectacle): Response
    {
        if ($this->isCsrfTokenValid('delete' . $spectacle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($spectacle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('spectacle_index');
    }
}
