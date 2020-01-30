<?php

namespace App\Controller;

use App\Repository\ActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ActorController extends AbstractController
{
    /**
     * @Route("/acteur" ,name="actor_index")
     * @param ActorRepository $actorRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ActorRepository $actorRepository)
    {
        $actors = $actorRepository -> findAll();
        return $this->render('actor/index.html.twig', [
            'actors' => $actors
        ]);
    }
}