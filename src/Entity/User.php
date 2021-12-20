<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ApiResource()
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
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
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullName;

    /**
     * @ORM\OneToMany(targetEntity=ProjectUsers::class, mappedBy="user", orphanRemoval=true)
     */
    private $projectUsers;

    /**
     * @ORM\OneToMany(targetEntity=Item::class, mappedBy="reporter")
     */
    private $reportedItems;

    /**
     * @ORM\OneToMany(targetEntity=Item::class, mappedBy="asignee")
     */
    private $asignedItems;

    /**
     * @ORM\OneToMany(targetEntity=ItemComment::class, mappedBy="user")
     */
    private $itemComments;

    public function __construct()
    {
        $this->projectUsers = new ArrayCollection();
        $this->reportedItems = new ArrayCollection();
        $this->asignedItems = new ArrayCollection();
        $this->itemComments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
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
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
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

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * @return Collection|ProjectUsers[]
     */
    public function getProjectUsers(): Collection
    {
        return $this->projectUsers;
    }

    public function addProjectUser(ProjectUsers $projectUser): self
    {
        if (!$this->projectUsers->contains($projectUser)) {
            $this->projectUsers[] = $projectUser;
            $projectUser->setUser($this);
        }

        return $this;
    }

    public function removeProjectUser(ProjectUsers $projectUser): self
    {
        if ($this->projectUsers->removeElement($projectUser)) {
            // set the owning side to null (unless already changed)
            if ($projectUser->getUser() === $this) {
                $projectUser->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Item[]
     */
    public function getReportedItems(): Collection
    {
        return $this->reportedItems;
    }

    public function addReportedItem(Item $reportedItem): self
    {
        if (!$this->reportedItems->contains($reportedItem)) {
            $this->reportedItems[] = $reportedItem;
            $reportedItem->setReporter($this);
        }

        return $this;
    }

    public function removeReportedItem(Item $reportedItem): self
    {
        if ($this->reportedItems->removeElement($reportedItem)) {
            // set the owning side to null (unless already changed)
            if ($reportedItem->getReporter() === $this) {
                $reportedItem->setReporter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Item[]
     */
    public function getAsignedItems(): Collection
    {
        return $this->asignedItems;
    }

    public function addAsignedItem(Item $asignedItem): self
    {
        if (!$this->asignedItems->contains($asignedItem)) {
            $this->asignedItems[] = $asignedItem;
            $asignedItem->setAsignee($this);
        }

        return $this;
    }

    public function removeAsignedItem(Item $asignedItem): self
    {
        if ($this->asignedItems->removeElement($asignedItem)) {
            // set the owning side to null (unless already changed)
            if ($asignedItem->getAsignee() === $this) {
                $asignedItem->setAsignee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ItemComment[]
     */
    public function getItemComments(): Collection
    {
        return $this->itemComments;
    }

    public function addItemComment(ItemComment $itemComment): self
    {
        if (!$this->itemComments->contains($itemComment)) {
            $this->itemComments[] = $itemComment;
            $itemComment->setUser($this);
        }

        return $this;
    }

    public function removeItemComment(ItemComment $itemComment): self
    {
        if ($this->itemComments->removeElement($itemComment)) {
            // set the owning side to null (unless already changed)
            if ($itemComment->getUser() === $this) {
                $itemComment->setUser(null);
            }
        }

        return $this;
    }
}
