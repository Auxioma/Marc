<?php

namespace App\Entity;

use App\Repository\PackageAdTextualRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PackageAdTextualRepository::class)
 */
class PackageAdTextual
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
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrDays;

    /**
     * @ORM\Column(type="float")
     */
    private $pricePerDay;


    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Announcement::class, mappedBy="packageAdTextual")
     */
    private $Announcement;

    public function __construct()
    {
        $this->Announcement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNbrDays(): ?int
    {
        return $this->nbrDays;
    }

    public function setNbrDays(int $nbrDays): self
    {
        $this->nbrDays = $nbrDays;

        return $this;
    }

    public function getPricePerDay(): ?float
    {
        return $this->pricePerDay;
    }

    public function setPricePerDay(float $pricePerDay): self
    {
        $this->pricePerDay = $pricePerDay;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Announcement[]
     */
    public function getAnnouncement(): Collection
    {
        return $this->Announcement;
    }

    public function addAnnouncement(Announcement $announcement): self
    {
        if (!$this->Announcement->contains($announcement)) {
            $this->Announcement[] = $announcement;
            $announcement->setPackageAdTextual($this);
        }

        return $this;
    }

    public function removeAnnouncement(Announcement $announcement): self
    {
        if ($this->Announcement->removeElement($announcement)) {
            // set the owning side to null (unless already changed)
            if ($announcement->getPackageAdTextual() === $this) {
                $announcement->setPackageAdTextual(null);
            }
        }

        return $this;
    }
}
