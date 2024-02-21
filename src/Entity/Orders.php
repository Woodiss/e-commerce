<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?User $user = null;

    #[ORM\Column(length: 11)]
    private ?string $reference = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\OneToMany(mappedBy: 'orders_id', targetEntity: OrdersDetails::class, orphanRemoval:true, cascade: ['persist'])]
    private Collection $ordersDetails;

    #[ORM\ManyToOne(inversedBy: 'orders', cascade: ['persist'])]
    private ?BillingAdresse $billingAdresse = null;

    #[ORM\ManyToOne(inversedBy: 'orders', cascade: ['persist'])]
    private ?DeliveryAdresse $deliveryAdresse = null;

    public function __construct()
    {
        $this->ordersDetails = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, OrdersDetails>
     */
    public function getOrdersDetails(): Collection
    {
        return $this->ordersDetails;
    }

    public function addOrdersDetail(OrdersDetails $ordersDetail): static
    {
        if (!$this->ordersDetails->contains($ordersDetail)) {
            $this->ordersDetails->add($ordersDetail);
            $ordersDetail->setOrdersId($this);
        }

        return $this;
    }

    public function removeOrdersDetail(OrdersDetails $ordersDetail): static
    {
        if ($this->ordersDetails->removeElement($ordersDetail)) {
            // set the owning side to null (unless already changed)
            if ($ordersDetail->getOrdersId() === $this) {
                $ordersDetail->setOrdersId(null);
            }
        }

        return $this;
    }

    public function getBillingAdresse(): ?BillingAdresse
    {
        return $this->billingAdresse;
    }

    public function setBillingAdresse(?BillingAdresse $billingAdresse): static
    {
        $this->billingAdresse = $billingAdresse;

        return $this;
    }

    public function getDeliveryAdresse(): ?deliveryAdresse
    {
        return $this->deliveryAdresse;
    }

    public function setDeliveryAdresse(?deliveryAdresse $deliveryAdresse): static
    {
        $this->deliveryAdresse = $deliveryAdresse;

        return $this;
    }
}
