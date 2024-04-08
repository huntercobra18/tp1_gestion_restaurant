<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ApiResource]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column]
    private ?int $phone = null;

    #[ORM\Column(length: 500)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $fidelity_number = null;

    /**
     * @var Collection<int, CommandeClient>
     */
    #[ORM\OneToMany(targetEntity: CommandeClient::class, mappedBy: 'client')]
    private Collection $commandeClients;

    public function __construct()
    {
        $this->commandeClients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getFidelityNumber(): ?string
    {
        return $this->fidelity_number;
    }

    public function setFidelityNumber(string $fidelity_number): static
    {
        $this->fidelity_number = $fidelity_number;

        return $this;
    }

    /**
     * @return Collection<int, CommandeClient>
     */
    public function getCommandeClients(): Collection
    {
        return $this->commandeClients;
    }

    public function addCommandeClient(CommandeClient $commandeClient): static
    {
        if (!$this->commandeClients->contains($commandeClient)) {
            $this->commandeClients->add($commandeClient);
            $commandeClient->setClient($this);
        }

        return $this;
    }

    public function removeCommandeClient(CommandeClient $commandeClient): static
    {
        if ($this->commandeClients->removeElement($commandeClient)) {
            // set the owning side to null (unless already changed)
            if ($commandeClient->getClient() === $this) {
                $commandeClient->setClient(null);
            }
        }

        return $this;
    }
}
