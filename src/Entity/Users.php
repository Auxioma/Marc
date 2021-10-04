<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = ['ROLE_ENR'];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PhoneNumber;

    /**
     * @ORM\Column(type="boolean")
     */
    private $afficheTelephone;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Compagny;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $FirstName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $civilite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CodePost;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Department;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Picture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Latitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Longitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $City;

    /**
     * @ORM\OneToMany(targetEntity=Announcement::class, mappedBy="users", orphanRemoval=true)
     */
    private $Announcement;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $OpenHours = [];

    /**
     * @var \DateTime $created_at
     * 
     * @Gedmo\Timestampable(on="create")     
     * @ORM\Column(type="datetime")
     */
    private $CreatedAt;

    /**
     * @var \DateTime $updated_at
     * 
     * @Gedmo\Timestampable(on="update") 
     * @ORM\Column(type="datetime")
     */
    private $UpdatedAt;

    /**
     * @ORM\OneToOne(targetEntity=Delivery::class, cascade={"persist", "remove"})
     */
    private $delivery;

    /**
     * @ORM\OneToOne(targetEntity=Horaires::class, cascade={"persist", "remove"})
     * @JoinColumn(onDelete="SET NULL")
     */
    private $horaires;

    public function __construct()
    {
        $this->Announcement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->PhoneNumber;
    }

    public function setPhoneNumber(?string $PhoneNumber): self
    {
        $this->PhoneNumber = $PhoneNumber;

        return $this;
    }

    public function getCompagny(): ?string
    {
        return $this->Compagny;
    }

    public function setCompagny(?string $Compagny): self
    {
        $this->Compagny = $Compagny;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(?string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(?string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(?string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getCodePost(): ?string
    {
        return $this->CodePost;
    }

    public function setCodePost(?string $CodePost): self
    {
        $this->CodePost = $CodePost;

        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->Department;
    }

    public function setDepartment(?string $Department): self
    {
        $this->Department = $Department;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->Picture;
    }

    public function setPicture(?string $Picture): self
    {
        $this->Picture = $Picture;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->Url;
    }

    public function setUrl(string $Url): self
    {
        $this->Url = $Url;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->Latitude;
    }

    public function setLatitude(?string $Latitude): self
    {
        $this->Latitude = $Latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->Longitude;
    }

    public function setLongitude(?string $Longitude): self
    {
        $this->Longitude = $Longitude;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(?string $City): self
    {
        $this->City = $City;

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
            $announcement->setUsers($this);
        }

        return $this;
    }

    public function removeAnnouncement(Announcement $announcement): self
    {
        if ($this->Announcement->removeElement($announcement)) {
            // set the owning side to null (unless already changed)
            if ($announcement->getUsers() === $this) {
                $announcement->setUsers(null);
            }
        }

        return $this;
    }

    public function getOpenHours(): ?array
    {
        return $this->OpenHours;
    }

    public function setOpenHours(?array $OpenHours): self
    {
        $this->OpenHours = $OpenHours;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

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

    /**
     * @return mixed
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * @param mixed $civilite
     */
    public function setCivilite($civilite): void
    {
        $this->civilite = $civilite;
    }

    /**
     * @return mixed
     */
    public function getAfficheTelephone()
    {
        return $this->afficheTelephone;
    }

    /**
     * @param mixed $afficheTelephone
     */
    public function setAfficheTelephone($afficheTelephone): void
    {
        $this->afficheTelephone = $afficheTelephone;
    }

    /**
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param mixed $dateNaissance
     */
    public function setDateNaissance($dateNaissance): void
    {
        $this->dateNaissance = $dateNaissance;
    }

    public function getDelivery(): ?Delivery
    {
        return $this->delivery;
    }

    public function setDelivery(?Delivery $delivery): self
    {
        $this->delivery = $delivery;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHoraires()
    {
        return $this->horaires;
    }

    /**
     * @param mixed $horaires
     */
    public function setHoraires($horaires): void
    {
        $this->horaires = $horaires;
    }


    public function openHoraire($day){
        if (!$this->horaires) return false;

        switch ($day){
            case 'lundi' : return $this->getHoraires()->getLundiMatinOuverture() and $this->getHoraires()->getLundiMidiFermeture();
            case 'mardi' : return $this->getHoraires()->getMardiMatinOuverture() and $this->getHoraires()->getMardiMidiFermeture();
            case 'mercredi' : return $this->getHoraires()->getMercrediMatinOuverture() and $this->getHoraires()->getMercrediMidiFermeture();
            case 'jeudi' : return $this->getHoraires()->getJeudiMatinOuverture() and $this->getHoraires()->getJeudiMidiFermeture();
            case 'vendredi' : return $this->getHoraires()->getVendrediMatinOuverture() and $this->getHoraires()->getVendrediMidiFermeture();
            case 'samedi' : return $this->getHoraires()->getSamediMatinOuverture() and $this->getHoraires()->getSamediMidiFermeture();
            case 'dimanche' : return $this->getHoraires()->getDimancheMatinOuverture() and $this->getHoraires()->getDimancheMidiFermeture();
        }

    }

    public function profileCreated(){
        return true;
    }

}
