<?php

namespace App\Controller;

use App\Repository\GamesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(GamesRepository $gamesRepository): Response
    {
        // Recuperar todos los juegos desde la base de datos
        $firstThree = array_slice($gamesRepository->findAll(), 0, 3);

        // Pasar los juegos a la plantilla base
        return $this->render('base.html.twig', [
            'games' => $firstThree,
        ]);
    }
}
