<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackgroundImageService extends AbstractController
{
    private $images = [
        'image/1.jpg',
        'image/2.jpg',
        'image/3.jpg',
        'image/4.jpg',
        'image/5.jpg',
        'image/6.jpg',
        'image/7.jpg'
    ];

    public function __construct()
    {
        
    }

    public function getRandomImage(): string
    {
        return $this->images[array_rand($this->images)];
    }
}