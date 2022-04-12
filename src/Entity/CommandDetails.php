<?php

namespace App\Entity;

use App\Repository\CommandDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandDetailsRepository::class)]
class CommandDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Command::class, inversedBy: 'commandDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private $command;

    #[ORM\OneToOne(inversedBy: 'commandDetails', targetEntity: Game::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $game;

    #[ORM\Column(type: 'integer')]
    private $quantity;

    #[ORM\Column(type: 'integer')]
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommand(): ?Command
    {
        return $this->command;
    }

    public function setCommand(?Command $command): self
    {
        $this->command = $command;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
}
