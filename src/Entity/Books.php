<?php

namespace App\Entity;

use App\Repository\BooksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BooksRepository::class)]
class Books
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $author = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $published_date = null;

    #[ORM\Column]
    private ?int $isbn = null;

    /**
     * @var Collection<int, reviews>
     */
    #[ORM\OneToMany(targetEntity: reviews::class, mappedBy: 'books', orphanRemoval: true)]
    private Collection $reviews;

    /**
     * @var Collection<int, UsersBooks>
     */
    #[ORM\OneToMany(targetEntity: UsersBooks::class, mappedBy: 'books', orphanRemoval: true)]
    private Collection $UsersBooks;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->UsersBooks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getPublishedDate(): ?\DateTimeInterface
    {
        return $this->published_date;
    }

    public function setPublishedDate(?\DateTimeInterface $published_date): static
    {
        $this->published_date = $published_date;

        return $this;
    }

    public function getIsbn(): ?int
    {
        return $this->isbn;
    }

    public function setIsbn(int $isbn): static
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * @return Collection<int, reviews>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(reviews $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setBooks($this);
        }

        return $this;
    }

    public function removeReview(reviews $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getBooks() === $this) {
                $review->setBooks(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UsersBooks>
     */
    public function getUsersBooks(): Collection
    {
        return $this->UsersBooks;
    }

    public function addUsersBook(UsersBooks $usersBook): static
    {
        if (!$this->UsersBooks->contains($usersBook)) {
            $this->UsersBooks->add($usersBook);
            $usersBook->setBooks($this);
        }

        return $this;
    }

    public function removeUsersBook(UsersBooks $usersBook): static
    {
        if ($this->UsersBooks->removeElement($usersBook)) {
            // set the owning side to null (unless already changed)
            if ($usersBook->getBooks() === $this) {
                $usersBook->setBooks(null);
            }
        }

        return $this;
    }
}
