<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 10)]
    private ?string $phone_number = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Orders::class, cascade: ['remove'])]
    #[ORM\OrderBy(["created_at" => "DESC"])]
    private Collection $orders;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: DeliveryAdresse::class, orphanRemoval: true)]
    private Collection $deliveryAdresses;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: BillingAdresse::class, orphanRemoval: true)]
    private Collection $billingAdresses;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->deliveryAdresses = new ArrayCollection();
        $this->billingAdresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
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
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
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

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): static
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    /**
     * @return Collection<int, Orders>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Orders $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setUser($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getUser() === $this) {
                $order->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DeliveryAdresse>
     */
    public function getDeliveryAdresses(): Collection
    {
        return $this->deliveryAdresses;
    }

    public function addDeliveryAdress(DeliveryAdresse $deliveryAdress): static
    {
        if (!$this->deliveryAdresses->contains($deliveryAdress)) {
            $this->deliveryAdresses->add($deliveryAdress);
            $deliveryAdress->setUser($this);
        }

        return $this;
    }

    public function removeDeliveryAdress(DeliveryAdresse $deliveryAdress): static
    {
        if ($this->deliveryAdresses->removeElement($deliveryAdress)) {
            // set the owning side to null (unless already changed)
            if ($deliveryAdress->getUser() === $this) {
                $deliveryAdress->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BillingAdresse>
     */
    public function getBillingAdresses(): Collection
    {
        return $this->billingAdresses;
    }

    public function addBillingAdress(BillingAdresse $billingAdress): static
    {
        if (!$this->billingAdresses->contains($billingAdress)) {
            $this->billingAdresses->add($billingAdress);
            $billingAdress->setUser($this);
        }

        return $this;
    }

    public function removeBillingAdress(BillingAdresse $billingAdress): static
    {
        if ($this->billingAdresses->removeElement($billingAdress)) {
            // set the owning side to null (unless already changed)
            if ($billingAdress->getUser() === $this) {
                $billingAdress->setUser(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->firstname . " " . $this->lastname;
    }
}
