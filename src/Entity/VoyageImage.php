<?php

namespace App\Entity;

use App\Repository\VoyageImageRepository;
use Doctrine\ORM\Mapping as ORM;

// use de vich
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: VoyageImageRepository::class)]
#[Vich\Uploadable]
class VoyageImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Vich\UploadableField(mapping: 'voyages', fileNameProperty: 'name', size: 'size')]
    private ?File $file = null;

    #[ORM\Column]
    private ?int $size = null;

    #[ORM\ManyToOne(inversedBy: 'voyageImages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Voyage $voyage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setFile(?File $file = null): self
    {
        $this->file = $file;

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getVoyage(): ?Voyage
    {
        return $this->voyage;
    }

    public function setVoyage(?Voyage $voyage): static
    {
        $this->voyage = $voyage;

        return $this;
    }
}
