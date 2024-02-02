<?php

namespace App\Entity;

use App\Repository\OrdersDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersDetailsRepository::class)]
class OrdersDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ordersDetails')]
    private ?Orders $orders = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Voyage $voyages = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?int $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrdersId(): ?Orders
    {
        return $this->orders;
    }

    public function setOrdersId(?Orders $orders): static
    {
        $this->orders = $orders;

        return $this;
    }

    public function getVoyagesId(): ?Voyage
    {
        return $this->voyages;
    }

    public function setVoyagesId(?Voyage $voyages): static
    {
        $this->voyages= $voyages;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

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
}
