<?php

namespace App\Entity;

use App\Repository\GuestbookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
    private $owner;

    /**
     * @ORM\OneToMany(targetEntity=GuestbookEntry::class, mappedBy="guestbook", orphanRemoval=true)
     */
    private $entries;

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
}
