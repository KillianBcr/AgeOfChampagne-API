<?php

namespace App\Entity;

use App\Repository\PartenaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PartenaireRepository::class)]


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

class Partenaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    #[Groups(['get_User', 'set_User'])]
    public function setNom(?string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    #[Groups(['get_User', 'set_User'])]
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    #[Groups(['get_User', 'set_User'])]
    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    #[Groups(['get_User', 'set_User'])]
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    #[Groups(['get_User', 'set_User'])]
    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }
}
