<?php

namespace App\Entity;

use App\Repository\PositionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PositionRepository::class)
 */
class Position
{

    const slugPositions = [
        'TOP_GAUCHE'            => 'Top gauche',
        'TOP_FIRST'             => 'top first',
        'TOP_DROITE'            => 'top droite',
        'PREMIUM_1'             => 'Premium 1',
        'PREMIUM_2'             => 'Premium 2',
        'PREMIUM_3'             => 'Premium 3',
        'PREMIUM_4'             => 'Premium 4',
        'GRANDE_PREMIUM_GAUCHE' => 'grande premium gauche',
        'GRANDE_PREMIUM_DROITE' => 'grande premium droite'
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=Adversing::class, mappedBy="position")
     */
    private $ads;

    public function __construct()
    {
        $this->ads = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Adversing[]
     */
    public function getAds(): Collection
    {
        return $this->ads;
    }

    public function addAd(Adversing $ad): self
    {
        if (!$this->ads->contains($ad)) {
            $this->ads[] = $ad;
            $ad->setPosition($this);
        }

        return $this;
    }

    public function removeAd(Adversing $ad): self
    {
        if ($this->ads->removeElement($ad)) {
            // set the owning side to null (unless already changed)
            if ($ad->getPosition() === $this) {
                $ad->setPosition(null);
            }
        }

        return $this;
    }
}
