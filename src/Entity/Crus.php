<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\CepageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CepageRepository::class)]
#[ApiFilter(SearchFilter::class, properties: ['name' => 'ipartial'])]
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
        new GetCollection(
            openapiContext: [
                'summary' => 'Information crus',
                'description' => 'Retourne les différentes informations des crus.',
            ],
            paginationEnabled: false,
            security: "is_granted('ROLE_USER')",
        ),
    ]
)]
class Crus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_User', 'set_User'])]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    #[Groups(['get_User', 'set_User'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get_User', 'set_User'])]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'crus')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get_User', 'set_User'])]
    private ?Cepage $cepage = null;

    #[ORM\OneToMany(mappedBy: 'crus', targetEntity: Carte::class)]
    #[Groups(['get_User', 'set_User'])]
    private Collection $cartes;

    public function __construct()
    {
        $this->cartes = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCepage(): ?Cepage
    {
        return $this->cepage;
    }

    public function setCepage(?Cepage $cepage): self
    {
        $this->cepage = $cepage;

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
            $carte->setCrus($this);
        }

        return $this;
    }

    public function removeCarte(Carte $carte): self
    {
        if ($this->cartes->removeElement($carte)) {
            // set the owning side to null (unless already changed)
            if ($carte->getCrus() === $this) {
                $carte->setCrus(null);
            }
        }

        return $this;
    }
}
