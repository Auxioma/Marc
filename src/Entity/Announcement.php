<?php

namespace App\Entity;

use App\Repository\AnnouncementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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

    /**
     * @var \DateTime $created_at
     * 
     * @Gedmo\Timestampable(on="create")     
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime $created_at
     * 
     * @Gedmo\Timestampable(on="update") 
     * @ORM\Column(type="datetime")
     */
    private $UpdatedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $StartAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $EndAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $IsVerified;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Offert;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->StartAt;
    }

    public function setStartAt(\DateTimeInterface $StartAt): self
    {
        $this->StartAt = $StartAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->EndAt;
    }

    public function setEndAt(\DateTimeInterface $EndAt): self
    {
        $this->EndAt = $EndAt;

        return $this;
    }

    public function getIsVerified(): ?bool
    {
        return $this->IsVerified;
    }

    public function setIsVerified(bool $IsVerified): self
    {
        $this->IsVerified = $IsVerified;

        return $this;
    }

    public function getOffert(): ?string
    {
        return $this->Offert;
    }

    public function setOffert(string $Offert): self
    {
        $this->Offert = $Offert;

        return $this;
    }
}
