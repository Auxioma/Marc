<?php

namespace App\Entity;

use App\Repository\HorairesRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass=HorairesRepository::class)
 */
class Horaires
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $LundiMatinOuverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $LundiMidiFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $LundiAPMOuverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $LundiAPMFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $MardiMatinOuverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $MardiMidiFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $MardiAPMOuverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $MardiAPMFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $MercrediMatinOuverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $MercrediMidiFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $MercrediAPMOuverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $MercrediAPMFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $JeudiMatinOuverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $JeudiMidiFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $JeudiAPMOuverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $JeudiAPMFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $VendrediMatinOuverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $VendrediMidiFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $VendrediAPMOuverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $VendrediAPMFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $SamediMatinOuverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $SamediMidiFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $SamediAPMOuverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $SamediAPMFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $DimancheMatinOuverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $DimancheMidiFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $DimancheAPMOuverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $DimancheAPMFermeture;

    /**
     * @ORM\OneToOne(targetEntity=Users::class, cascade={"persist", "remove"})
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLundiMatinOuverture(): ?\DateTimeInterface
    {
        return $this->LundiMatinOuverture;
    }

    public function setLundiMatinOuverture(?\DateTimeInterface $LundiMatinOuverture): self
    {
        $this->LundiMatinOuverture = $LundiMatinOuverture;

        return $this;
    }

    public function getLundiMidiFermeture(): ?\DateTimeInterface
    {
        return $this->LundiMidiFermeture;
    }

    public function setLundiMidiFermeture(?\DateTimeInterface $LundiMidiFermeture): self
    {
        $this->LundiMidiFermeture = $LundiMidiFermeture;

        return $this;
    }

    public function getLundiAPMOuverture(): ?\DateTimeInterface
    {
        return $this->LundiAPMOuverture;
    }

    public function setLundiAPMOuverture(?\DateTimeInterface $LundiAPMOuverture): self
    {
        $this->LundiAPMOuverture = $LundiAPMOuverture;

        return $this;
    }

    public function getLundiAPMFermeture(): ?\DateTimeInterface
    {
        return $this->LundiAPMFermeture;
    }

    public function setLundiAPMFermeture(?\DateTimeInterface $LundiAPMFermeture): self
    {
        $this->LundiAPMFermeture = $LundiAPMFermeture;

        return $this;
    }

    public function getMardiMatinOuverture(): ?\DateTimeInterface
    {
        return $this->MardiMatinOuverture;
    }

    public function setMardiMatinOuverture(?\DateTimeInterface $MardiMatinOuverture): self
    {
        $this->MardiMatinOuverture = $MardiMatinOuverture;

        return $this;
    }

    public function getMardiMidiFermeture(): ?\DateTimeInterface
    {
        return $this->MardiMidiFermeture;
    }

    public function setMardiMidiFermeture(?\DateTimeInterface $MardiMidiFermeture): self
    {
        $this->MardiMidiFermeture = $MardiMidiFermeture;

        return $this;
    }

    public function getMardiAPMOuverture(): ?\DateTimeInterface
    {
        return $this->MardiAPMOuverture;
    }

    public function setMardiAPMOuverture(?\DateTimeInterface $MardiAPMOuverture): self
    {
        $this->MardiAPMOuverture = $MardiAPMOuverture;

        return $this;
    }

    public function getMardiAPMFermeture(): ?\DateTimeInterface
    {
        return $this->MardiAPMFermeture;
    }

    public function setMardiAPMFermeture(?\DateTimeInterface $MardiAPMFermeture): self
    {
        $this->MardiAPMFermeture = $MardiAPMFermeture;

        return $this;
    }

    public function getMercrediMatinOuverture(): ?\DateTimeInterface
    {
        return $this->MercrediMatinOuverture;
    }

    public function setMercrediMatinOuverture(?\DateTimeInterface $MercrediMatinOuverture): self
    {
        $this->MercrediMatinOuverture = $MercrediMatinOuverture;

        return $this;
    }

    public function getMercrediMidiFermeture(): ?\DateTimeInterface
    {
        return $this->MercrediMidiFermeture;
    }

    public function setMercrediMidiFermeture(?\DateTimeInterface $MercrediMidiFermeture): self
    {
        $this->MercrediMidiFermeture = $MercrediMidiFermeture;

        return $this;
    }

    public function getMercrediAPMOuverture(): ?\DateTimeInterface
    {
        return $this->MercrediAPMOuverture;
    }

    public function setMercrediAPMOuverture(?\DateTimeInterface $MercrediAPMOuverture): self
    {
        $this->MercrediAPMOuverture = $MercrediAPMOuverture;

        return $this;
    }

    public function getMercrediAPMFermeture(): ?\DateTimeInterface
    {
        return $this->MercrediAPMFermeture;
    }

    public function setMercrediAPMFermeture(?\DateTimeInterface $MercrediAPMFermeture): self
    {
        $this->MercrediAPMFermeture = $MercrediAPMFermeture;

        return $this;
    }

    public function getJeudiMatinOuverture(): ?\DateTimeInterface
    {
        return $this->JeudiMatinOuverture;
    }

    public function setJeudiMatinOuverture(?\DateTimeInterface $JeudiMatinOuverture): self
    {
        $this->JeudiMatinOuverture = $JeudiMatinOuverture;

        return $this;
    }

    public function getJeudiMidiFermeture(): ?\DateTimeInterface
    {
        return $this->JeudiMidiFermeture;
    }

    public function setJeudiMidiFermeture(?\DateTimeInterface $JeudiMidiFermeture): self
    {
        $this->JeudiMidiFermeture = $JeudiMidiFermeture;

        return $this;
    }

    public function getJeudiAPMOuverture(): ?\DateTimeInterface
    {
        return $this->JeudiAPMOuverture;
    }

    public function setJeudiAPMOuverture(?\DateTimeInterface $JeudiAPMOuverture): self
    {
        $this->JeudiAPMOuverture = $JeudiAPMOuverture;

        return $this;
    }

    public function getJeudiAPMFermeture(): ?\DateTimeInterface
    {
        return $this->JeudiAPMFermeture;
    }

    public function setJeudiAPMFermeture(?\DateTimeInterface $JeudiAPMFermeture): self
    {
        $this->JeudiAPMFermeture = $JeudiAPMFermeture;

        return $this;
    }

    public function getVendrediMatinOuverture(): ?\DateTimeInterface
    {
        return $this->VendrediMatinOuverture;
    }

    public function setVendrediMatinOuverture(?\DateTimeInterface $VendrediMatinOuverture): self
    {
        $this->VendrediMatinOuverture = $VendrediMatinOuverture;

        return $this;
    }

    public function getVendrediMidiFermeture(): ?\DateTimeInterface
    {
        return $this->VendrediMidiFermeture;
    }

    public function setVendrediMidiFermeture(?\DateTimeInterface $VendrediMidiFermeture): self
    {
        $this->VendrediMidiFermeture = $VendrediMidiFermeture;

        return $this;
    }

    public function getVendrediAPMOuverture(): ?\DateTimeInterface
    {
        return $this->VendrediAPMOuverture;
    }

    public function setVendrediAPMOuverture(?\DateTimeInterface $VendrediAPMOuverture): self
    {
        $this->VendrediAPMOuverture = $VendrediAPMOuverture;

        return $this;
    }

    public function getVendrediAPMFermeture(): ?\DateTimeInterface
    {
        return $this->VendrediAPMFermeture;
    }

    public function setVendrediAPMFermeture(?\DateTimeInterface $VendrediAPMFermeture): self
    {
        $this->VendrediAPMFermeture = $VendrediAPMFermeture;

        return $this;
    }

    public function getSamediMatinOuverture(): ?\DateTimeInterface
    {
        return $this->SamediMatinOuverture;
    }

    public function setSamediMatinOuverture(?\DateTimeInterface $SamediMatinOuverture): self
    {
        $this->SamediMatinOuverture = $SamediMatinOuverture;

        return $this;
    }

    public function getSamediMidiFermeture(): ?\DateTimeInterface
    {
        return $this->SamediMidiFermeture;
    }

    public function setSamediMidiFermeture(?\DateTimeInterface $SamediMidiFermeture): self
    {
        $this->SamediMidiFermeture = $SamediMidiFermeture;

        return $this;
    }

    public function getSamediAPMOuverture(): ?\DateTimeInterface
    {
        return $this->SamediAPMOuverture;
    }

    public function setSamediAPMOuverture(?\DateTimeInterface $SamediAPMOuverture): self
    {
        $this->SamediAPMOuverture = $SamediAPMOuverture;

        return $this;
    }

    public function getSamediAPMFermeture(): ?\DateTimeInterface
    {
        return $this->SamediAPMFermeture;
    }

    public function setSamediAPMFermeture(?\DateTimeInterface $SamediAPMFermeture): self
    {
        $this->SamediAPMFermeture = $SamediAPMFermeture;

        return $this;
    }

    public function getDimancheMatinOuverture(): ?\DateTimeInterface
    {
        return $this->DimancheMatinOuverture;
    }

    public function setDimancheMatinOuverture(?\DateTimeInterface $DimancheMatinOuverture): self
    {
        $this->DimancheMatinOuverture = $DimancheMatinOuverture;

        return $this;
    }

    public function getDimancheMidiFermeture(): ?\DateTimeInterface
    {
        return $this->DimancheMidiFermeture;
    }

    public function setDimancheMidiFermeture(?\DateTimeInterface $DimancheMidiFermeture): self
    {
        $this->DimancheMidiFermeture = $DimancheMidiFermeture;

        return $this;
    }

    public function getDimancheAPMOuverture(): ?\DateTimeInterface
    {
        return $this->DimancheAPMOuverture;
    }

    public function setDimancheAPMOuverture(?\DateTimeInterface $DimancheAPMOuverture): self
    {
        $this->DimancheAPMOuverture = $DimancheAPMOuverture;

        return $this;
    }

    public function getDimancheAPMFermeture(): ?\DateTimeInterface
    {
        return $this->DimancheAPMFermeture;
    }

    public function setDimancheAPMFermeture(?\DateTimeInterface $DimancheAPMFermeture): self
    {
        $this->DimancheAPMFermeture = $DimancheAPMFermeture;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }
}
