<?php

namespace App\Entity;

use App\Repository\TypeRepasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepasRepository::class)]
class TypeRepas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?float $tarif = null;

    #[ORM\OneToMany(mappedBy: 'typeRepas', targetEntity: RepasMenu::class)]
    private Collection $repasMenus;

    public function __construct()
    {
        $this->repasMenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(float $tarif): static
    {
        $this->tarif = $tarif;

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
            $repasMenu->setTypeRepas($this);
        }

        return $this;
    }

    public function removeRepasMenu(RepasMenu $repasMenu): static
    {
        if ($this->repasMenus->removeElement($repasMenu)) {
            // set the owning side to null (unless already changed)
            if ($repasMenu->getTypeRepas() === $this) {
                $repasMenu->setTypeRepas(null);
            }
        }

        return $this;
    }
}
