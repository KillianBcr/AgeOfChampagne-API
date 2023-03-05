<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegionRepository::class)]
class Region
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nom = null;

//    #[ORM\OneToMany(mappedBy: 'region', targetEntity: Carte::class)]
//    private Collection $cartes;
//
//
//    public function __construct()
//{
//    $this->cartes = new ArrayCollection();
//}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

//    /**
//     * @return Collection<int, Carte>
//     */
//    public function getCartes(): Collection
//    {
//        return $this->cartes;
//    }
//
//    public function addCarte(Carte $carte): self
//    {
//        if (!$this->cartes->contains($carte)) {
//            $this->cartes->add($carte);
//            $carte->setRegion($this);
//        }
//
//        return $this;
//    }
//
//    public function removeCarte(Carte $carte): self
//    {
//        if ($this->cartes->removeElement($carte)) {
//            // set the owning side to null (unless already changed)
//            if ($carte->getRegion() === $this) {
//                $carte->setRegion(null);
//            }
//        }
//
//        return $this;
//    }
}
