<?php

namespace App\Controller;

use App\Entity\Games;
use App\Entity\Favorite;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FavoriteController extends AbstractController
{

    #[Route("/games/{id}/favorite/{route}", name: "game_favorite")]

    public function toggleFavorite(Request $request, Games $game, EntityManagerInterface $em, $route): RedirectResponse
    {
        $user = $this->getUser();

        
        // Verificar si el usuario ya tiene el juego como favorito
        $favorite = $em->getRepository(Favorite::class)->findOneBy(['user' => $user, 'game' => $game]);

        if ($favorite) {
            // Eliminar el favorito
            $em->remove($favorite);
        } else {
            // Crear un nuevo favorito
            $favorite = new Favorite();
            $favorite->setUser($user);
            $favorite->setGame($game);
            $em->persist($favorite);
        }

        $em->flush();
        if ($route == 'games') {
        // Redirigir a la página de detalles del juego o a la lista de juegos
            return $this->redirectToRoute('app_games_index', ['id' => $game->getId()]);
        }
        if ($route == 'favorites')  {
            return $this->redirectToRoute('game_search', ['id' => $game->getId()]);
    }
}
}
