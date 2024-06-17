<?php

namespace App\Entity;

use App\Repository\UsersBooksRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersBooksRepository::class)]
class UsersBooks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $checkout_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $return_date = null;

    #[ORM\ManyToOne(inversedBy: 'UsersBooks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $users = null;

    #[ORM\ManyToOne(inversedBy: 'UsersBooks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Books $books = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCheckaoutDate(): ?\DateTimeInterface
    {
        return $this->checkout_date;
    }

    public function setCheckaoutDate(?\DateTimeInterface $checkout_date): static
    {
        $this->checkout_date = $checkout_date;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->return_date;
    }

    public function setReturnDate(?\DateTimeInterface $return_date): static
    {
        $this->return_date = $return_date;

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
