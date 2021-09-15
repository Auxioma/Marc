<?php

namespace App\Entity;

use App\Repository\PriceAnnouncementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PriceAnnouncementRepository::class)
 */
class PriceAnnouncement
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
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NumerDay;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Price;

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

    public function getNumerDay(): ?string
    {
        return $this->NumerDay;
    }

    public function setNumerDay(string $NumerDay): self
    {
        $this->NumerDay = $NumerDay;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->Price;
    }

    public function setPrice(string $Price): self
    {
        $this->Price = $Price;

        return $this;
    }
}
