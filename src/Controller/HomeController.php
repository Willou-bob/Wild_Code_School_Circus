<?php

namespace App\Controller;

use App\Repository\SpectacleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/index")
     * @param SpectacleRepository $spectacleRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(SpectacleRepository $spectacleRepository)
    {
        $spectacles = $spectacleRepository -> findAll();
        return $this->render('home/index.html.twig', [
            'spectacles' => $spectacles
            ]);
    }
}