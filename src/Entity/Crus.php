<?php

namespace App\Entity;

use App\Repository\CrusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CrusRepository::class)]
class Crus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
