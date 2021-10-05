<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PictureRepository::class)
 */
class Picture
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
     * @ORM\Column(type="string", length=1)
     */
    private $Position;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Alt;

    /**
     * @var
     */
    private $imgBase64;

    /**
     * @ORM\ManyToOne(targetEntity=Announcement::class, inversedBy="Picture")
     * @ORM\JoinColumn(nullable=false)
     */
    private $announcement;

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

    public function getPosition(): ?string
    {
        return $this->Position;
    }

    public function setPosition(string $Position): self
    {
        $this->Position = $Position;

        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->Alt;
    }

    public function setAlt(string $Alt): self
    {
        $this->Alt = $Alt;

        return $this;
    }

    public function getAnnouncement(): ?Announcement
    {
        return $this->announcement;
    }

    public function setAnnouncement(?Announcement $announcement): self
    {
        $this->announcement = $announcement;
        $announcement->addPicture($this);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImgBase64()
    {
        return $this->imgBase64;
    }

    /**
     * @param mixed $imgBase64
     */
    public function setImgBase64($imgBase64): void
    {
        $this->imgBase64 = $imgBase64;
    }
}
