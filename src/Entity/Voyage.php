<?php

namespace App\Entity;


use App\Repository\VoyageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

// use de vich
// use Symfony\Component\HttpFoundation\File\File;
// use Vich\UploaderBundle\Mapping\Annotation as Vich;

// #[Vich\Uploadable]
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

    // #[Vich\UploadableField(mapping: 'voyages', fileNameProperty: 'image')]
    // private ?File $imageFile = null;

    // #[ORM\Column(length: 255)]
    // private ?string $image = null;


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

    // public function setImageFile(?File $imageFile = null): void
    // {
    //     $this->imageFile = $imageFile;
    // }

    // public function getImageFile(): ?File
    // {
    //     return $this->imageFile;
    // }
    // public function getImage()
    // {
    //     return $this->image;
    // }

    // public function setImage($image): static
    // {
    //     $this->image = $image;

    //     return $this;
    // }

    /**
     * @return Collection<int, VoyageImage>
     */
    public function getimages(): Collection
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
