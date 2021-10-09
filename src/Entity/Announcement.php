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

    const statusCreated         = "CREATED";
    const statusPAID            = "PAID";
    const statusPaymentFailed   = "PAYMENT_FAILED";
    const statusCancled         = "PAYMENT_CANCLED";
    const statusPendingApprouve = "PENDING_APPROUVE";
    const statusAPPROUVED       = "APPROUVED";
    const statusREJECTED        = "REJECTED";
    const statusRETOURNED       = "RETOURNED";

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titlediscount;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $Discount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $promoTitle;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ShortDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $LongDescription;

    /**
     * @ORM\OneToMany(targetEntity=Picture::class, mappedBy="announcement", orphanRemoval=true ,cascade={"persist"})
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $UpdatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $StartAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $EndAt;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status = self::statusCreated;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $IsOnline = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $IsVerified = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $IsPaid = false;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="Announcement")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @Gedmo\Slug(fields={"Title"})
     * @ORM\Column(type="string", length=255)
     */
    private $Slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $YouTube;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="subAnnouncements")
     */
    private $subCategory;

    /**
     * @ORM\ManyToOne(targetEntity=PackageAdTextual::class, inversedBy="Announcement")
     */
    private $packageAdTextual;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $options;

    /**
     * @ORM\Column(type="float")
     */
    private $montantTotal = 0;

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

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

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

    public function getYouTube(): ?string
    {
        return $this->YouTube;
    }

    public function setYouTube(?string $YouTube): self
    {
        $this->YouTube = $YouTube;

        return $this;
    }

    public function getSubCategory(): ?Category
    {
        return $this->subCategory;
    }

    public function setSubCategory(?Category $subCategory): self
    {
        $this->subCategory = $subCategory;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitlediscount()
    {
        return $this->titlediscount;
    }

    /**
     * @param mixed $titlediscount
     */
    public function setTitlediscount($titlediscount): void
    {
        $this->titlediscount = $titlediscount;
    }

    public function getPackageAdTextual(): ?PackageAdTextual
    {
        return $this->packageAdTextual;
    }

    public function setPackageAdTextual(?PackageAdTextual $packageAdTextual): self
    {
        $this->packageAdTextual = $packageAdTextual;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options): void
    {
        $this->options = $options;
    }

    /**
     * @return mixed
     */
    public function getPromoTitle()
    {
        return $this->promoTitle;
    }

    /**
     * @param mixed $promoTitle
     */
    public function setPromoTitle($promoTitle): void
    {
        $this->promoTitle = $promoTitle;
    }

    /**
     * @return bool
     */
    public function isIsPaid(): bool
    {
        return $this->IsPaid;
    }

    /**
     * @param bool $IsPaid
     */
    public function setIsPaid(bool $IsPaid): void
    {
        $this->IsPaid = $IsPaid;
    }

    /**
     * @return int
     */
    public function getMontantTotal(): int
    {
        return $this->montantTotal;
    }

    /**
     * @param int $montantTotal
     */
    public function setMontantTotal(int $montantTotal): void
    {
        $this->montantTotal = $montantTotal;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isIsOnline(): bool
    {
        return $this->IsOnline;
    }

    /**
     * @param bool $IsOnline
     */
    public function setIsOnline(bool $IsOnline): void
    {
        $this->IsOnline = $IsOnline;
    }

}
