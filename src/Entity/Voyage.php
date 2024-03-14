<?php

namespace App\Entity;


use App\Repository\VoyageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoyageRepository::class)]
class Voyage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: "text")]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'voyage', targetEntity: VoyageImage::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $images;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?float $longitude = null;

    #[ORM\Column]
    private ?float $latitude = null;

    #[ORM\Column]
    private ?bool $parking = null;

    #[ORM\Column]
    private ?bool $free_wifi = null;

    #[ORM\Column]
    private ?bool $pool = null;

    #[ORM\Column]
    private ?bool $pets_accept = null;

    #[ORM\Column(length: 255)]
    private ?string $little_desc = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, VoyageImage>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(VoyageImage $voyageImage): static
    {
        if (!$this->images->contains($voyageImage)) {
            $this->images->add($voyageImage);
            $voyageImage->setVoyage($this);
        }

        return $this;
    }

    public function removeImage(VoyageImage $voyageImage): static
    {
        if ($this->images->removeElement($voyageImage)) {
            // set the owning side to null (unless already changed)
            if ($voyageImage->getVoyage() === $this) {
                $voyageImage->setVoyage(null);
            }
        }

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function isParking(): ?bool
    {
        return $this->parking;
    }

    public function setParking(bool $parking): static
    {
        $this->parking = $parking;

        return $this;
    }

    public function isFreeWifi(): ?bool
    {
        return $this->free_wifi;
    }

    public function setFreeWifi(bool $free_wifi): static
    {
        $this->free_wifi = $free_wifi;

        return $this;
    }

    public function isPool(): ?bool
    {
        return $this->pool;
    }

    public function setPool(bool $pool): static
    {
        $this->pool = $pool;

        return $this;
    }

    public function isPetsAccept(): ?bool
    {
        return $this->pets_accept;
    }

    public function setPetsAccept(bool $pets_accept): static
    {
        $this->pets_accept = $pets_accept;

        return $this;
    }

    public function getLittleDesc(): ?string
    {
        return $this->little_desc;
    }

    public function setLittleDesc(string $little_desc): static
    {
        $this->little_desc = $little_desc;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }
}
