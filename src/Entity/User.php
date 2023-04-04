<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use App\Controller\GetMeController;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            normalizationContext: ['groups' => ['get_User']]
        ),
        new GetCollection(
            uriTemplate: '/me',
            controller: GetMeController::class,
            openapiContext: [
                'responses' => [
                    '200', '401' => [
                        'description' => 'Get connected User',
                        'summary' => 'Get connected User',
                    ],
                ],
            ],
            paginationEnabled: false,
            normalizationContext: ['groups' => ['get_Me', 'get_User']],
            security: "is_granted('ROLE_USER')"
        ),

        new Put(
            denormalizationContext: ['groups' => ['set_User']],
            security: "is_granted('ROLE_USER') and object == user"
        ),
        new Patch(
            denormalizationContext: ['groups' => ['set_User']],
            security: "is_granted('ROLE_USER') and object == user"
        ),
    ],
    normalizationContext: ['groups' => ['get_User', 'get_Me']]
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_User'])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups(['set_User', 'get_Me', 'get_User'])]
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Groups(['set_User'])]
    private ?string $password = null;

    #[ORM\Column(length: 30)]
    #[Assert\Regex(
        pattern: '/[<>&"]/',
        match: false,
    )]
    #[Groups(['get_User', 'set_User'])]
    private ?string $nom = null;

    #[ORM\Column(length: 30)]
    #[Assert\Regex(
        pattern: '/[<>&"]/',
        match: false,
    )]
    #[Groups(['get_User', 'set_User'])]
    private ?string $prenom = null;

    #[ORM\Column(length: 30)]
    #[Assert\Regex(
        pattern: '/[<>&"]/',
        match: false,
    )]
    #[Groups(['get_User', 'set_User'])]
    private ?string $telephone = null;

    #[ORM\Column(type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column(length: 6)]
    #[Assert\Regex(
        pattern: '/[<>&"]/',
        match: false,
    )]
    #[Groups(['get_User', 'set_User'])]
    private ?string $cp = null;

    #[ORM\Column(length: 30)]
    #[Assert\Regex(
        pattern: '/[<>&"]/',
        match: false,
    )]
    #[Groups(['get_User', 'set_User'])]
    private ?string $ville = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datenais = null;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->updated_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getDatenais(): ?\DateTimeInterface
    {
        return $this->datenais;
    }

    public function setDatenais(\DateTimeInterface $datenais): self
    {
        $this->datenais = $datenais;

        return $this;
    }
}
