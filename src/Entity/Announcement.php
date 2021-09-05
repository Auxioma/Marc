<?php

namespace App\Entity;

use App\Repository\AnnouncementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnnouncementRepository::class)
 */
class Announcement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $Discount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShortDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $LongDescription;

    /**
     * @ORM\OneToMany(targetEntity=Picture::class, mappedBy="announcement", orphanRemoval=true)
     */
    private $Picture;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="announcements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Category;

    public function __construct()
    {
        $this->Picture = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDiscount(): ?string
    {
        return $this->Discount;
    }

    public function setDiscount(?string $Discount): self
    {
        $this->Discount = $Discount;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->ShortDescription;
    }

    public function setShortDescription(?string $ShortDescription): self
    {
        $this->ShortDescription = $ShortDescription;

        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->LongDescription;
    }

    public function setLongDescription(?string $LongDescription): self
    {
        $this->LongDescription = $LongDescription;

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPicture(): Collection
    {
        return $this->Picture;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->Picture->contains($picture)) {
            $this->Picture[] = $picture;
            $picture->setAnnouncement($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->Picture->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getAnnouncement() === $this) {
                $picture->setAnnouncement(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $Category): self
    {
        $this->Category = $Category;

        return $this;
    }
}
