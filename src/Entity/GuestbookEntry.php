<?php

namespace App\Entity;

use App\Repository\GuestbookEntryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=GuestbookEntryRepository::class)
 */
class GuestbookEntry
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="guestbookEntries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     */
    #[Assert\Length(min: 10, max: 100)]
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=Guestbook::class, inversedBy="entries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $guestbook;

    public function __toString(): string
    {
        return $this->getAuthor()->getUsername() . '-' . substr($this->getContent(), 0, 50);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getGuestbook(): ?Guestbook
    {
        return $this->guestbook;
    }

    public function setGuestbook(?Guestbook $guestbook): self
    {
        $this->guestbook = $guestbook;

        return $this;
    }
}
