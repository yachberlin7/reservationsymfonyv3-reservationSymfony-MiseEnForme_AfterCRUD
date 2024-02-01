<?php

namespace App\Entity;

use App\Repository\JourMenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JourMenuRepository::class)]
class JourMenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateJour = null;

    #[ORM\ManyToOne(inversedBy: 'jourMenus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SemaineResa $semaineResa = null;

    #[ORM\OneToMany(mappedBy: 'jourMenu', targetEntity: RepasMenu::class)]
    private Collection $repasMenus;

    public function __construct()
    {
        $this->repasMenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateJour(): ?\DateTimeInterface
    {
        return $this->dateJour;
    }

    public function setDateJour(\DateTimeInterface $dateJour): static
    {
        $this->dateJour = $dateJour;

        return $this;
    }

    public function getSemaineResa(): ?SemaineResa
    {
        return $this->semaineResa;
    }

    public function setSemaineResa(?SemaineResa $semaineResa): static
    {
        $this->semaineResa = $semaineResa;

        return $this;
    }

    /**
     * @return Collection<int, RepasMenu>
     */
    public function getRepasMenus(): Collection
    {
        return $this->repasMenus;
    }

    public function addRepasMenu(RepasMenu $repasMenu): static
    {
        if (!$this->repasMenus->contains($repasMenu)) {
            $this->repasMenus->add($repasMenu);
            $repasMenu->setJourMenu($this);
        }

        return $this;
    }


    public function removeRepasMenu(RepasMenu $repasMenu): static
    {
        if ($this->repasMenus->removeElement($repasMenu)) {
            // set the owning side to null (unless already changed)
            if ($repasMenu->getJourMenu() === $this) {
                $repasMenu->setJourMenu(null);
            }
        }

        return $this;
    }
}
