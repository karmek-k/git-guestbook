<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="integer")
     */
    private $githubId;

    /**
     * @ORM\OneToMany(targetEntity=Guestbook::class, mappedBy="owner", orphanRemoval=true)
     */
    private $guestbooks;

    /**
     * @ORM\OneToMany(targetEntity=GuestbookEntry::class, mappedBy="author", orphanRemoval=true)
     */
    private $guestbookEntries;

    public function __construct()
    {
        $this->guestbooks = new ArrayCollection();
        $this->guestbookEntries = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getUsername();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
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
     * This method can be removed in Symfony 6.0 - is not needed for apps that do not check user passwords.
     *
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return null;
    }

    /**
     * This method can be removed in Symfony 6.0 - is not needed for apps that do not check user passwords.
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

    public function getGithubId(): ?int
    {
        return $this->githubId;
    }

    public function setGithubId(int $githubId): self
    {
        $this->githubId = $githubId;

        return $this;
    }

    /**
     * @return Collection|Guestbook[]
     */
    public function getGuestbooks(): Collection
    {
        return $this->guestbooks;
    }

    public function addGuestbook(Guestbook $guestbook): self
    {
        if (!$this->guestbooks->contains($guestbook)) {
            $this->guestbooks[] = $guestbook;
            $guestbook->setOwner($this);
        }

        return $this;
    }

    public function removeGuestbook(Guestbook $guestbook): self
    {
        if ($this->guestbooks->removeElement($guestbook)) {
            // set the owning side to null (unless already changed)
            if ($guestbook->getOwner() === $this) {
                $guestbook->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GuestbookEntry[]
     */
    public function getGuestbookEntries(): Collection
    {
        return $this->guestbookEntries;
    }

    public function addGuestbookEntry(GuestbookEntry $guestbookEntry): self
    {
        if (!$this->guestbookEntries->contains($guestbookEntry)) {
            $this->guestbookEntries[] = $guestbookEntry;
            $guestbookEntry->setAuthor($this);
        }

        return $this;
    }

    public function removeGuestbookEntry(GuestbookEntry $guestbookEntry): self
    {
        if ($this->guestbookEntries->removeElement($guestbookEntry)) {
            // set the owning side to null (unless already changed)
            if ($guestbookEntry->getAuthor() === $this) {
                $guestbookEntry->setAuthor(null);
            }
        }

        return $this;
    }
}
