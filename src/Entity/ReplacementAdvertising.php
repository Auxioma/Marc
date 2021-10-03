<?php

namespace App\Entity;

use App\Repository\ReplacementAdvertisingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReplacementAdvertisingRepository::class)
 */
class ReplacementAdvertising
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
    private $Picture;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $position;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TitlePossition;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Size;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPicture(): ?string
    {
        return $this->Picture;
    }

    public function setPicture(string $Picture): self
    {
        $this->Picture = $Picture;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getTitlePossition(): ?string
    {
        return $this->TitlePossition;
    }

    public function setTitlePossition(string $TitlePossition): self
    {
        $this->TitlePossition = $TitlePossition;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->Size;
    }

    public function setSize(string $Size): self
    {
        $this->Size = $Size;

        return $this;
    }
}
