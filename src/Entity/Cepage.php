<?php

namespace App\Entity;

use App\Repository\CepageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CepageRepository::class)]
class Cepage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'cepage', targetEntity: Crus::class)]
    private Collection $crus;

    #[ORM\OneToMany(mappedBy: 'cepage', targetEntity: Carte::class)]
    private Collection $cartes;

    public function __construct()
    {
        $this->crus = new ArrayCollection();
        $this->cartes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Crus>
     */
    public function getCrus(): Collection
    {
        return $this->crus;
    }

    public function addCru(Crus $cru): self
    {
        if (!$this->crus->contains($cru)) {
            $this->crus->add($cru);
            $cru->setCepage($this);
        }

        return $this;
    }

    public function removeCru(Crus $cru): self
    {
        if ($this->crus->removeElement($cru)) {
            // set the owning side to null (unless already changed)
            if ($cru->getCepage() === $this) {
                $cru->setCepage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Carte>
     */
    public function getCartes(): Collection
    {
        return $this->cartes;
    }

    public function addCarte(Carte $carte): self
    {
        if (!$this->cartes->contains($carte)) {
            $this->cartes->add($carte);
            $carte->setCepage($this);
        }

        return $this;
    }

    public function removeCarte(Carte $carte): self
    {
        if ($this->cartes->removeElement($carte)) {
            // set the owning side to null (unless already changed)
            if ($carte->getCepage() === $this) {
                $carte->setCepage(null);
            }
        }

        return $this;
    }
}
