<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\CollectionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CollectionRepository::class)]
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
class Collection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_User', 'set_User'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['get_User', 'set_User'])]
    private ?int $userID = null;

    #[ORM\Column]
    #[Groups(['get_User', 'set_User'])]
    private ?int $cardID = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserID(): ?int
    {
        return $this->userID;
    }

    public function setUserID(int $userID): self
    {
        $this->userID = $userID;

        return $this;
    }

    public function getCardID(): ?int
    {
        return $this->cardID;
    }

    public function setCardID(int $cardID): self
    {
        $this->cardID = $cardID;

        return $this;
    }
}
