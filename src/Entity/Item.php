<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 * @ApiResource()
 */
class Item
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reportedItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reporter;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="asignedItems")
     */
    private $asignee;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $storyPoints;

    /**
     * @ORM\ManyToOne(targetEntity=ItemType::class, inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     */
    private $itemType;

    /**
     * @ORM\ManyToOne(targetEntity=ItemPriority::class, inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     */
    private $itemPriority;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    /**
     * @ORM\OneToMany(targetEntity=ItemComment::class, mappedBy="item", orphanRemoval=true)
     */
    private $itemComments;

    /**
     * @ORM\ManyToMany(targetEntity=Sprint::class, mappedBy="items")
     */
    private $sprints;

    public function __construct()
    {
        $this->itemComments = new ArrayCollection();
        $this->sprints = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getReporter(): ?User
    {
        return $this->reporter;
    }

    public function setReporter(?User $reporter): self
    {
        $this->reporter = $reporter;

        return $this;
    }

    public function getAsignee(): ?User
    {
        return $this->asignee;
    }

    public function setAsignee(?User $asignee): self
    {
        $this->asignee = $asignee;

        return $this;
    }

    public function getStoryPoints(): ?int
    {
        return $this->storyPoints;
    }

    public function setStoryPoints(?int $storyPoints): self
    {
        $this->storyPoints = $storyPoints;

        return $this;
    }

    public function getItemType(): ?ItemType
    {
        return $this->itemType;
    }

    public function setItemType(?ItemType $itemType): self
    {
        $this->itemType = $itemType;

        return $this;
    }

    public function getItemPriority(): ?ItemPriority
    {
        return $this->itemPriority;
    }

    public function setItemPriority(?ItemPriority $itemPriority): self
    {
        $this->itemPriority = $itemPriority;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

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
            $itemComment->setItem($this);
        }

        return $this;
    }

    public function removeItemComment(ItemComment $itemComment): self
    {
        if ($this->itemComments->removeElement($itemComment)) {
            // set the owning side to null (unless already changed)
            if ($itemComment->getItem() === $this) {
                $itemComment->setItem(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sprint[]
     */
    public function getSprints(): Collection
    {
        return $this->sprints;
    }

    public function addSprint(Sprint $sprint): self
    {
        if (!$this->sprints->contains($sprint)) {
            $this->sprints[] = $sprint;
            $sprint->addItem($this);
        }

        return $this;
    }

    public function removeSprint(Sprint $sprint): self
    {
        if ($this->sprints->removeElement($sprint)) {
            $sprint->removeItem($this);
        }

        return $this;
    }
}
