<?php

namespace App\Entity;

use App\Entity\Picture;
use App\Entity\Category;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GameRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert; // permet de definir toute cette ligne comme Assert. 

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $title;

    #[ORM\Column(type: 'integer')]
    private $rental_price;

    #[ORM\Column(type: 'integer')]
    private $selling_price;

    #[ORM\Column(type: 'string', length: 50)]
    private $age;

    #[ORM\Column(type: 'string', length: 50)]
    private $nb_players;

    #[ORM\Column(type: 'string', length: 50)]
    private $play_time;

    #[ORM\Column(type: 'text')]
    private $material;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'integer')]
    private $stock;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $grade;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'games')]
    #[Assert\NotBlank] // Assert\NotBlank permet de vérifier que la valeur n'est pas vide dans le fichier GameType.php
    private $category;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Picture::class)]
    private $picture;

    #[ORM\OneToOne(mappedBy: 'game', targetEntity: CommandDetails::class, cascade: ['persist', 'remove'])]
    private $commandDetails;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->picture = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getRentalPrice(): ?int
    {
        return $this->rental_price;
    }

    public function setRentalPrice(int $rental_price): self
    {
        $this->rental_price = $rental_price;

        return $this;
    }

    public function getSellingPrice(): ?int
    {
        return $this->selling_price;
    }

    public function setSellingPrice(int $selling_price): self
    {
        $this->selling_price = $selling_price;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(string $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getNbPlayers(): ?string
    {
        return $this->nb_players;
    }

    public function setNbPlayers(string $nb_players): self
    {
        $this->nb_players = $nb_players;

        return $this;
    }

    public function getPlayTime(): ?string
    {
        return $this->play_time;
    }

    public function setPlayTime(string $play_time): self
    {
        $this->play_time = $play_time;

        return $this;
    }

    public function getMaterial(): ?string
    {
        return $this->material;
    }

    public function setMaterial(string $material): self
    {
        $this->material = $material;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getGrade(): ?int
    {
        return $this->grade;
    }

    public function setGrade(?int $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

    public function __toString()
    {
        // Cette fonction est créée pour afficher le titre dans le selecteur de catégories car title est dans game.
        return $this->title;
    }

    /**
     * @return Collection<int, Picture>
     */
    public function getPicture(): Collection
    {
        return $this->picture;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->picture->contains($picture)) {
            $this->picture[] = $picture;
            $picture->setGame($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->picture->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getGame() === $this) {
                $picture->setGame(null);
            }
        }

        return $this;
    }

    public function getCommandDetails(): ?CommandDetails
    {
        return $this->commandDetails;
    }

    public function setCommandDetails(CommandDetails $commandDetails): self
    {
        // set the owning side of the relation if necessary
        if ($commandDetails->getGame() !== $this) {
            $commandDetails->setGame($this);
        }

        $this->commandDetails = $commandDetails;

        return $this;
    }

}
