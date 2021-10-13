<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $datatransID;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="factures")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Announcement::class)
     */
    private $annonce;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Adversing::class, mappedBy="facture")
     */
    private $adversings;

    public function __construct()
    {
        $this->adversings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDatatransID(): ?string
    {
        return $this->datatransID;
    }

    public function setDatatransID(string $datatransID): self
    {
        $this->datatransID = $datatransID;

        return $this;
    }

    public function getClient(): ?Users
    {
        return $this->client;
    }

    public function setClient(?Users $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getAnnonce(): ?Announcement
    {
        return $this->annonce;
    }

    public function setAnnonce(?Announcement $annonce): self
    {
        $this->annonce = $annonce;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|Adversing[]
     */
    public function getAdversings(): Collection
    {
        return $this->adversings;
    }

    public function addAdversing(Adversing $adversing): self
    {
        if (!$this->adversings->contains($adversing)) {
            $this->adversings[] = $adversing;
            $adversing->addFacture($this);
        }

        return $this;
    }

    public function removeAdversing(Adversing $adversing): self
    {
        if ($this->adversings->removeElement($adversing)) {
            $adversing->removeFacture($this);
        }

        return $this;
    }
}
