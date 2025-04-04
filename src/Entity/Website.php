<?php

namespace App\Entity;

use App\Repository\WebsiteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WebsiteRepository::class)]
class Website
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1000)]
    private ?string $lastname_firstname = null;

    #[ORM\Column(length: 2000)]
    private ?string $website_type = null;

    #[ORM\ManyToOne(inversedBy: 'websites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 20000)]
    private ?string $email = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastnameFirstname(): ?string
    {
        return $this->lastname_firstname;
    }

    public function setLastnameFirstname(string $lastname_firstname): self
    {
        $this->lastname_firstname = $lastname_firstname;

        return $this;
    }

    public function getWebsiteType(): ?string
    {
        return $this->website_type;
    }

    public function setWebsiteType(string $website_type): self
    {
        $this->website_type = $website_type;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
