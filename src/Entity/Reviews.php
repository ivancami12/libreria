<?php

namespace App\Entity;

use App\Repository\ReviewsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewsRepository::class)]
class Reviews
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $review_content = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $publicado = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $users = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Books $books = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getReviewContent(): ?string
    {
        return $this->review_content;
    }

    public function setReviewContent(?string $review_content): static
    {
        $this->review_content = $review_content;

        return $this;
    }

    public function getPublicado(): ?\DateTimeInterface
    {
        return $this->publicado;
    }

    public function setPublicado(?\DateTimeInterface $publicado): static
    {
        $this->publicado = $publicado;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): static
    {
        $this->users = $users;

        return $this;
    }

    public function getBooks(): ?Books
    {
        return $this->books;
    }

    public function setBooks(?Books $books): static
    {
        $this->books = $books;

        return $this;
    }
}
