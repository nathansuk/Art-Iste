<?php

namespace App\Entity;

use App\Repository\ArtisanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtisanRepository::class)
 */
class Artisan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="artisans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $kbis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AdressePro;

    /**
     * @ORM\Column(type="boolean")
     */
    private $atHome;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canMove;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $activityPerimeter;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified;

    /**
     * @ORM\ManyToOne(targetEntity=ArtisansJob::class, inversedBy="artisans")
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cover_image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vitrineName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vitrineDesc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coverName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=ArtisanPhotos::class, mappedBy="artisan")
     */
    private $artisanPhotos;

    public function __construct()
    {
        $this->artisanPhotos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getKbis(): ?string
    {
        return $this->kbis;
    }

    public function setKbis(?string $kbis): self
    {
        $this->kbis = $kbis;

        return $this;
    }

    public function getAdressePro(): ?string
    {
        return $this->AdressePro;
    }

    public function setAdressePro(string $AdressePro): self
    {
        $this->AdressePro = $AdressePro;

        return $this;
    }

    public function getAtHome(): ?bool
    {
        return $this->atHome;
    }

    public function setAtHome(bool $atHome): self
    {
        $this->atHome = $atHome;

        return $this;
    }

    public function getCanMove(): ?bool
    {
        return $this->canMove;
    }

    public function setCanMove(bool $canMove): self
    {
        $this->canMove = $canMove;

        return $this;
    }

    public function getActivityPerimeter(): ?int
    {
        return $this->activityPerimeter;
    }

    public function setActivityPerimeter(?int $activityPerimeter): self
    {
        $this->activityPerimeter = $activityPerimeter;

        return $this;
    }

    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getCategory(): ?ArtisansJob
    {
        return $this->category;
    }

    public function setCategory(?ArtisansJob $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCoverImage(): ?string
    {
        return $this->cover_image;
    }

    public function setCoverImage(string $cover_image): self
    {
        $this->cover_image = $cover_image;

        return $this;
    }

    public function getVitrineName(): ?string
    {
        return $this->vitrineName;
    }

    public function setVitrineName(string $vitrineName): self
    {
        $this->vitrineName = $vitrineName;

        return $this;
    }

    public function getVitrineDesc(): ?string
    {
        return $this->vitrineDesc;
    }

    public function setVitrineDesc(string $vitrineDesc): self
    {
        $this->vitrineDesc = $vitrineDesc;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getCoverName(): ?string
    {
        return $this->coverName;
    }

    public function setCoverName(string $coverName): self
    {
        $this->coverName = $coverName;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|ArtisanPhotos[]
     */
    public function getArtisanPhotos(): Collection
    {
        return $this->artisanPhotos;
    }

    public function addArtisanPhoto(ArtisanPhotos $artisanPhoto): self
    {
        if (!$this->artisanPhotos->contains($artisanPhoto)) {
            $this->artisanPhotos[] = $artisanPhoto;
            $artisanPhoto->setArtisan($this);
        }

        return $this;
    }

    public function removeArtisanPhoto(ArtisanPhotos $artisanPhoto): self
    {
        if ($this->artisanPhotos->removeElement($artisanPhoto)) {
            // set the owning side to null (unless already changed)
            if ($artisanPhoto->getArtisan() === $this) {
                $artisanPhoto->setArtisan(null);
            }
        }

        return $this;
    }

    public function __toString(): string {
        return $this->getVitrineName();
    }
}
