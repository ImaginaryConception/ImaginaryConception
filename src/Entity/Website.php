<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\WebsiteRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: WebsiteRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Cette adresse email est déjà utilisée !')]
class Website
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180)]
    #[Assert\NotBlank(message: 'Le prénom ne peut pas être vide.')]
    private $firstname;

    #[ORM\Column(type: 'string', length: 180)]
    #[Assert\NotBlank(message: 'Le nom ne peut pas être vide.')]
    private $lastname;

    #[ORM\Column(type: 'string', length: 180)]
    #[Assert\NotBlank(message: 'L\'email ne peut pas être vide.')]
    #[Assert\Email(message: 'L\'email {{ value }} n\'est pas un email valide.')]
    private $email;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $phone;

    #[ORM\Column(type: 'string', length: 180, nullable: true)]
    private $companyName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $existingWebsite;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $type;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $estimatedPages;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private $logo;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $likedWebsites = null;

    #[ORM\Column(type: 'array', length: 255, nullable: true)]
    private $specificFunctions = [];

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $deadline;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    #[ORM\Column(type: 'integer', nullable: false)]
    private $estimatedBudget;

    #[ORM\Column(type: 'text', nullable: true)]
    private $additionalInfo;

    #[ORM\Column(type: 'string', length: 50, nullable: false)]
    private $currentStage = 'initial';

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'websites')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $user = null;

    // Id
    public function getId(): ?int
    {
        return $this->id;
    }

    // Firstname
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    // Lastname
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }

    // Email
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getCurrentStage(): ?string
    {
        return $this->currentStage;
    }

    public function setCurrentStage(string $currentStage): self
    {
        $this->currentStage = $currentStage;
        return $this;
    }

    // Phone
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    // CompanyName
    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;
        return $this;
    }

    // ExistingWebsite
    public function getExistingWebsite(): ?string
    {
        return $this->existingWebsite;
    }

    public function setExistingWebsite(?string $existingWebsite): self
    {
        $this->existingWebsite = $existingWebsite;
        return $this;
    }

    // Type
    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;
        return $this;
    }

    // EstimatedPages
    public function getEstimatedPages(): ?string
    {
        return $this->estimatedPages;
    }

    public function setEstimatedPages(?string $estimatedPages): self
    {
        $this->estimatedPages = $estimatedPages;
        return $this;
    }

    // Logo
    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;
        return $this;
    }

    // LikedWebsites
    public function getLikedWebsites(): ?string
    {
        return $this->likedWebsites;
    }

    public function setLikedWebsites(?string $likedWebsites): self
    {
        $this->likedWebsites = $likedWebsites;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    // SpecificFunctions
    public function getSpecificFunctions(): array
    {
        return $this->specificFunctions;
    }

    public function setSpecificFunctions(array $specificFunctions): self
    {
        $this->specificFunctions = $specificFunctions;
        return $this;
    }

    // Deadline
    public function getDeadline(): ?\DateTimeInterface
    {
        return $this->deadline;
    }

    public function setDeadline(?\DateTimeInterface $deadline): self
    {
        $this->deadline = $deadline;
        return $this;
    }

    // EstimatedBudget
    public function getEstimatedBudget(): ?int
    {
        return $this->estimatedBudget;
    }

    public function setEstimatedBudget(int $estimatedBudget): self
    {
        $this->estimatedBudget = $estimatedBudget;
        return $this;
    }

    // AdditionalInfo
    public function getAdditionalInfo(): ?string
    {
        return $this->additionalInfo;
    }

    public function setAdditionalInfo(?string $additionalInfo): self
    {
        $this->additionalInfo = $additionalInfo;
        return $this;
    }

    // Status
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $status;

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;
        return $this;
    }
}