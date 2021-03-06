<?php

namespace App\Controller;

use App\Repository\ActorRepository;
use App\Repository\SpectacleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     * @param SpectacleRepository $spectacleRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(SpectacleRepository $spectacleRepository, ActorRepository $actors)
    {
        $spectacles = $spectacleRepository -> findAll();
        return $this->render('home/index.html.twig', [
            'spectacles' => $spectacles,
            'actors' => $actors
            ]);
    }
}