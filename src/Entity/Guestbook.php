<?php

namespace App\Entity;

use App\Repository\GuestbookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=GuestbookRepository::class)
 */
class Guestbook
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="guestbooks")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Assert\NotNull]
    private $owner;

    /**
     * @ORM\OneToMany(targetEntity=GuestbookEntry::class, mappedBy="guestbook", orphanRemoval=true)
     */
    private $entries;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Assert\Length(min: 5, max: 20)]
    #[Assert\NotBlank]
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $confirmEntries;

    public function __construct()
    {
        $this->entries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection|GuestbookEntry[]
     */
    public function getEntries(): Collection
    {
        return $this->entries;
    }

    public function addEntry(GuestbookEntry $entry): self
    {
        if (!$this->entries->contains($entry)) {
            $this->entries[] = $entry;
            $entry->setGuestbook($this);
        }

        return $this;
    }

    public function removeEntry(GuestbookEntry $entry): self
    {
        if ($this->entries->removeElement($entry)) {
            // set the owning side to null (unless already changed)
            if ($entry->getGuestbook() === $this) {
                $entry->setGuestbook(null);
            }
        }

        return $this;
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

    public function getConfirmEntries(): ?bool
    {
        return $this->confirmEntries;
    }

    public function setConfirmEntries(bool $confirmEntries): self
    {
        $this->confirmEntries = $confirmEntries;

        return $this;
    }
}
