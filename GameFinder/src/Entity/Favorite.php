<?php

namespace App\Entity;

use App\Repository\FavoriteRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: FavoriteRepository::class)]
class Favorite 
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Games $game = null;

    #[ORM\ManyToOne]
    private ?User $user = null;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGame(): ?Games
    {
        return $this->game;
    }

    public function setGame(?Games $game): static
    {
        $this->game = $game;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

}
