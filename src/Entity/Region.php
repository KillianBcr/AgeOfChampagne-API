<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\RegionRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: RegionRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new Post(
            security: "is_granted('ROLE_ADMIN')",
        ),
        new Put(
            security: "is_granted('ROLE_ADMIN') and object.getUser() == user",
        ),
        new Patch(
            security: "is_granted('ROLE_ADMIN') and object.getUser() == user",
        ),
        new Delete(
            security: "is_granted('ROLE_ADMIN') and object.getUser() == user",
        ),
        new Put(
            normalizationContext: ['groups' => ['get_User', 'get_Me']],
            denormalizationContext: ['groups' => ['set_User']],
            security: "is_granted('ROLE_USER') and object == user"
        ),
        new Patch(
            normalizationContext: ['groups' => ['get_User', 'get_Me']],
            denormalizationContext: ['groups' => ['set_User']],
            security: "is_granted('ROLE_USER') and object == user"
        ),
    ]
)]
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
    // {
//    $this->cartes = new ArrayCollection();
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    #[Groups(['get_User', 'set_User'])]
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
