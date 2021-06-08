<?php

namespace App\Entity;

use App\Repository\ArtisanPhotosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtisanPhotosRepository::class)
 */
class ArtisanPhotos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Artisan::class, inversedBy="artisanPhotos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $artisan;

    /**
     * @ORM\Column(type="boolean")
     */
    private $valid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtisan(): ?Artisan
    {
        return $this->artisan;
    }

    public function setArtisan(?Artisan $artisan): self
    {
        $this->artisan = $artisan;

        return $this;
    }

    public function getValid(): ?bool
    {
        return $this->valid;
    }

    public function setValid(bool $valid): self
    {
        $this->valid = $valid;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }
}
