<?php

namespace App\Controller;

use App\Service\BackgroundImageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private $backgroundImageService;

    public function __construct(BackgroundImageService $backgroundImageService)
    {
        $this->backgroundImageService = $backgroundImageService;
    }

    #[Route('/blabla', name: 'homepage')]
    public function index(): Response
    {
        $randomImage = $this->backgroundImageService->getRandomImage();

        return $this->render('default/index.html.twig', [
            'backgroundImage' => $randomImage,
        ]);
    }
}