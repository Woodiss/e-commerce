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

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'voyage', targetEntity: VoyageImage::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $images;

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
}
