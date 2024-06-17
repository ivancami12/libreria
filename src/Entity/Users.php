<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $username = null;

    #[ORM\Column(nullable: true)]
    private ?bool $enabled = null;

    #[ORM\OneToOne(inversedBy: 'users', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Addresses $addresses = null;

    /**
     * @var Collection<int, reviews>
     */
    #[ORM\OneToMany(targetEntity: Reviews::class, mappedBy: 'users', orphanRemoval: true)]
    private Collection $reviews;

    /**
     * @var Collection<int, UsersBooks>
     */
    #[ORM\OneToMany(targetEntity: UsersBooks::class, mappedBy: 'users', orphanRemoval: true)]
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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(?bool $enabled): static
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getAddresses(): ?Addresses
    {
        return $this->addresses;
    }

    public function setAddresses(Addresses $addresses): static
    {
        $this->addresses = $addresses;

        return $this;
    }

    /**
     * @return Collection<int, reviews>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Reviews $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setUsers($this);
        }

        return $this;
    }

    public function removeReview(Reviews $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getUsers() === $this) {
                $review->setUsers(null);
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
            $usersBook->setUsers($this);
        }

        return $this;
    }

    public function removeUsersBook(UsersBooks $usersBook): static
    {
        if ($this->UsersBooks->removeElement($usersBook)) {
            // set the owning side to null (unless already changed)
            if ($usersBook->getUsers() === $this) {
                $usersBook->setUsers(null);
            }
        }

        return $this;
    }
}
