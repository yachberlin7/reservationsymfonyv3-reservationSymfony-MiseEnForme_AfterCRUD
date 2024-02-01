<?php

namespace App\Entity;

use App\Repository\RepasMenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RepasMenuRepository::class)]
class RepasMenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'repasMenus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeRepas $typeRepas = null;

    #[ORM\ManyToOne(inversedBy: 'repasMenus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?JourMenu $jourMenu = null;

    #[ORM\OneToMany(mappedBy: 'repasMenu', targetEntity: Reservation::class)]
    private Collection $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTypeRepas(): ?TypeRepas
    {
        return $this->typeRepas;
    }

    public function setTypeRepas(?TypeRepas $typeRepas): static
    {
        $this->typeRepas = $typeRepas;

        return $this;
    }

    public function getJourMenu(): ?JourMenu
    {
        return $this->jourMenu;
    }

    public function setJourMenu(?JourMenu $jourMenu): static
    {
        $this->jourMenu = $jourMenu;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setRepasMenu($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getRepasMenu() === $this) {
                $reservation->setRepasMenu(null);
            }
        }

        return $this;
    }
}
