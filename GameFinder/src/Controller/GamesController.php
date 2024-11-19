<?php

namespace App\Controller;

use App\Entity\Games;
use App\Form\GamesType;
use App\Repository\GamesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\GameSearchType;
use App\Service\BackgroundImageService;


#[Route('/games')]
class GamesController extends AbstractController
{
    private $backgroundImageService;
    private $randomImage;

    public function __construct(BackgroundImageService $backgroundImageService)
    {
        $this->backgroundImageService = $backgroundImageService;
        $this->randomImage = $this->backgroundImageService->getRandomImage();
    }
    #[Route('/', name: 'app_games_index', methods: ['GET', 'POST'])]
    public function index(Request $request, GamesRepository $gamesRepository, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GameSearchType::class);
        $form->handleRequest($request);

        $games = $gamesRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $genre = $form->get('genre')->getData();
            $games = $entityManager->getRepository(Games::class)
                ->createQueryBuilder('g')
                ->join('g.genres', 'genre')
                ->where('genre.id = :genreId')
                ->setParameter('genreId', $genre->getId())
                ->getQuery()
                ->getResult();
        }

        return $this->render('games/index.html.twig', [
            'form' => $form->createView(),
            'games' => $games,
            'backgroundImage' => $this->randomImage,
        ]);

        //return $this->render('games/index.html.twig', [
         //   'games' => $gamesRepository->findAll(),
       // ]);
    }

    #[Route('/search', name: 'game_search')]
    public function searchByGenre(Request $request, GamesRepository $gamesRepository, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GameSearchType::class);
        $form->handleRequest($request);

        $games = $gamesRepository->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $genre = $form->get('genre')->getData();
            $games = $entityManager->getRepository(Games::class)
                ->createQueryBuilder('g')
                ->join('g.genres', 'genre')
                ->where('genre.id = :genreId')
                ->setParameter('genreId', $genre->getId())
                ->getQuery()
                ->getResult();
        }

        return $this->render('games/search.html.twig', [
            'form' => $form->createView(),
            'games' => $games,
            'backgroundImage' => $this->randomImage,
        ]);
    }
    
    #[Route('/find/{search}', name: 'app_games_search', methods: ['GET'])]
       public function search($search, GamesRepository $gamesRepository): Response
    {
             
        $filtered = $gamesRepository->createQueryBuilder('game')
            ->where('game.title LIKE :filter')
            ->setParameter('filter', '%'.$search.'%')
            ->getQuery()
            ->getResult();

        return $this->render('games/index.html.twig', [
            'games' => $filtered,
            'backgroundImage' => $this->randomImage,
        ]);
    }

    #[Route('/new', name: 'app_games_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $game = new Games();
        $form = $this->createForm(GamesType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($game);
            $entityManager->flush();

            return $this->redirectToRoute('app_games_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('games/new.html.twig', [
            'game' => $game,
            'form' => $form,
            'backgroundImage' => $this->randomImage,
        ]);
    }

    #[Route('/{id}', name: 'app_games_show', methods: ['GET'])]
    public function show(Games $game): Response
    {
        return $this->render('games/show.html.twig', [
            'game' => $game,
            'backgroundImage' => $this->randomImage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_games_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Games $game, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GamesType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_games_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('games/edit.html.twig', [
            'game' => $game,
            'form' => $form,
            'backgroundImage' => $this->randomImage,
        ]);
    }

    #[Route('/{id}', name: 'app_games_delete', methods: ['POST'])]
    public function delete(Request $request, Games $game, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$game->getId(), $request->request->get('_token'))) {
            $entityManager->remove($game);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_games_index', [], Response::HTTP_SEE_OTHER);
    }
}
