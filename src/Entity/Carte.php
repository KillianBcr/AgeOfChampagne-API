<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 *
 * @ApiResource(
 *     collectionOperations={
 *         "get"={"security"="is_granted('ROLE_USER')"},
 *         "post"={"security"="is_granted('ROLE_USER')"}
 *     },
 *     itemOperations={
 *         "get"={"security"="is_granted('ROLE_USER')"},
 *         "put"={"security"="is_granted('ROLE_USER')"},
 *         "delete"={"security"="is_granted('ROLE_USER')"}
 *     },
 *     attributes={
 *         "pagination_items_per_page"=10
 *     }
 * )
 *
 * @ApiFilter(SearchFilter::class, properties={"name": "partial", "description": "partial", "public": "exact"})
 * @ApiFilter(OrderFilter::class, properties={"name", "createdAt", "notes"})
 */
class Carte
{
    /**
     * @ORM\Id
     *
     * @ORM\GeneratedValue
     *
     * @ORM\Column(type="integer")
     *
     * @ApiProperty(identifier=true)
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=40)
     *
     * @Assert\NotBlank
     */
    private ?string $name = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description = null;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $public = true;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="integer")
     */
    private int $notes = 0;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isPublic(): bool
    {
        return $this->public;
    }

    public function setPublic(bool $public): self
    {
        $this->public = $public;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getNotes(): int
    {
        return $this->notes;
    }

    public function setNotes(int $notes): self
    {
        $this->notes = $notes;

        return $this;
    }
}
