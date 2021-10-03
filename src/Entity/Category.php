<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    public function __toString()
    {
        return $this->Name;
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @Gedmo\Slug(fields={"Name"})
     * @ORM\Column(type="string", length=255)
     */
    private $Slug;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="categories")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $Parent;

    /**
     * @ORM\OneToMany(targetEntity=Category::class, mappedBy="Parent")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Announcement::class, mappedBy="Category")
     */
    private $announcements;

    /**
     * @ORM\OneToMany(targetEntity=Announcement::class, mappedBy="subCategory")
     */
    private $subAnnouncements;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->announcements = new ArrayCollection();
        $this->subAnnouncements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->Slug;
    }

    public function setSlug(string $Slug): self
    {
        $this->Slug = $Slug;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->Parent;
    }

    public function setParent(?self $Parent): self
    {
        $this->Parent = $Parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(self $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setParent($this);
        }

        return $this;
    }

    public function removeCategory(self $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getParent() === $this) {
                $category->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Announcement[]
     */
    public function getAnnouncements(): Collection
    {
        return $this->announcements;
    }

    public function addAnnouncement(Announcement $announcement): self
    {
        if (!$this->announcements->contains($announcement)) {
            $this->announcements[] = $announcement;
            $announcement->setCategory($this);
        }

        return $this;
    }

    public function removeAnnouncement(Announcement $announcement): self
    {
        if ($this->announcements->removeElement($announcement)) {
            // set the owning side to null (unless already changed)
            if ($announcement->getCategory() === $this) {
                $announcement->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Announcement[]
     */
    public function getSubAnnouncements(): Collection
    {
        return $this->subAnnouncements;
    }

    public function addSubAnnouncement(Announcement $subAnnouncement): self
    {
        if (!$this->subAnnouncements->contains($subAnnouncement)) {
            $this->subAnnouncements[] = $subAnnouncement;
            $subAnnouncement->setSubCategory($this);
        }

        return $this;
    }

    public function removeSubAnnouncement(Announcement $subAnnouncement): self
    {
        if ($this->subAnnouncements->removeElement($subAnnouncement)) {
            // set the owning side to null (unless already changed)
            if ($subAnnouncement->getSubCategory() === $this) {
                $subAnnouncement->setSubCategory(null);
            }
        }

        return $this;
    }

}
