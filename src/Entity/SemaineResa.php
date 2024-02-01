<?php

namespace App\Entity;

use App\Repository\SemaineResaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SemaineResaRepository::class)]
class SemaineResa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column]
    private ?int $numeroSemaine = null;

    #[ORM\OneToMany(mappedBy: 'semaineResa', targetEntity: JourMenu::class)]
    private Collection $jourMenus;

    public function __construct()
    {
        $this->jourMenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getNumeroSemaine(): ?int
    {
        return $this->numeroSemaine;
    }

    public function setNumeroSemaine(int $numeroSemaine): static
    {
        $this->numeroSemaine = $numeroSemaine;

        return $this;
    }

    /**
     * @return Collection<int, JourMenu>
     */
    public function getJourMenus(): Collection
    {
        return $this->jourMenus;
    }

    public function addJourMenu(JourMenu $jourMenu): static
    {
        if (!$this->jourMenus->contains($jourMenu)) {
            $this->jourMenus->add($jourMenu);
            $jourMenu->setSemaineResa($this);
        }

        return $this;
    }

    public function removeJourMenu(JourMenu $jourMenu): static
    {
        if ($this->jourMenus->removeElement($jourMenu)) {
            // set the owning side to null (unless already changed)
            if ($jourMenu->getSemaineResa() === $this) {
                $jourMenu->setSemaineResa(null);
            }
        }

        return $this;
    }
}
