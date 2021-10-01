<?php

namespace App\Entity;

use App\Repository\DeliveryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeliveryRepository::class)
 */
class Delivery
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $service;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hubereat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $est;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $smood;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $deindeal;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param mixed $service
     */
    public function setService($service): void
    {
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function getHubereat()
    {
        return $this->hubereat;
    }

    /**
     * @param mixed $hubereat
     */
    public function setHubereat($hubereat): void
    {
        $this->hubereat = $hubereat;
    }

    /**
     * @return mixed
     */
    public function getEst()
    {
        return $this->est;
    }

    /**
     * @param mixed $est
     */
    public function setEst($est): void
    {
        $this->est = $est;
    }

    /**
     * @return mixed
     */
    public function getSmood()
    {
        return $this->smood;
    }

    /**
     * @param mixed $smood
     */
    public function setSmood($smood): void
    {
        $this->smood = $smood;
    }

    /**
     * @return mixed
     */
    public function getDeindeal()
    {
        return $this->deindeal;
    }

    /**
     * @param mixed $deindeal
     */
    public function setDeindeal($deindeal): void
    {
        $this->deindeal = $deindeal;
    }

}
