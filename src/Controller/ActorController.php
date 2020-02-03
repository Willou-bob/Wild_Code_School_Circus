<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Repository\ActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @param ActorRepository $actorRepository
     * @return Response
     * @Route("spectacle/actor/{id}", name="show_actor")
     */
    public function showActor(ActorRepository $actorRepository) :Response
    {
        $spectacle = $actorRepository->getSpectacle();
        $actorRepository = $spectacle->getActor();
        return $this->render('spetacle/actor.html.twig',
            ['actorRepository'=>$actorRepository,
                'spectacle'=>$spectacle
                ]);
    }
}
