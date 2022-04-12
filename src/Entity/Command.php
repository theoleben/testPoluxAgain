<?php

namespace App\Entity;

use App\Repository\CommandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandRepository::class)]
class Command
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $type;

    #[ORM\OneToOne(inversedBy: 'command', targetEntity: User::class, cascade: ['persist', 'remove'])]
    private $user;

    #[ORM\Column(type: 'integer')]
    private $total_amount;

    #[ORM\Column(type: 'datetime_immutable')]
    private $created_at;

    #[ORM\OneToMany(mappedBy: 'command', targetEntity: CommandDetails::class)]
    private $commandDetails;

    public function __construct()
    {
        $this->commandDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTotalAmount(): ?int
    {
        return $this->total_amount;
    }

    public function setTotalAmount(int $total_amount): self
    {
        $this->total_amount = $total_amount;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, CommandDetails>
     */
    public function getCommandDetails(): Collection
    {
        return $this->commandDetails;
    }

    public function addCommandDetail(CommandDetails $commandDetail): self
    {
        if (!$this->commandDetails->contains($commandDetail)) {
            $this->commandDetails[] = $commandDetail;
            $commandDetail->setCommand($this);
        }

        return $this;
    }

    public function removeCommandDetail(CommandDetails $commandDetail): self
    {
        if ($this->commandDetails->removeElement($commandDetail)) {
            // set the owning side to null (unless already changed)
            if ($commandDetail->getCommand() === $this) {
                $commandDetail->setCommand(null);
            }
        }

        return $this;
    }

}
