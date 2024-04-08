<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PlatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatRepository::class)]
#[ApiResource]
class Plat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price = null;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\ManyToMany(targetEntity: Produit::class, inversedBy: 'plats')]
    private Collection $composition;

    /**
     * @var Collection<int, CommandeClient>
     */
    #[ORM\ManyToMany(targetEntity: CommandeClient::class, mappedBy: 'plat')]
    private Collection $commandeClients;

    #[ORM\Column]
    private ?bool $inMenu = null;

    public function __construct()
    {
        $this->composition = new ArrayCollection();
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getComposition(): Collection
    {
        return $this->composition;
    }

    public function addComposition(Produit $composition): static
    {
        if (!$this->composition->contains($composition)) {
            $this->composition->add($composition);
        }

        return $this;
    }

    public function removeComposition(Produit $composition): static
    {
        $this->composition->removeElement($composition);

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
            $commandeClient->addPlat($this);
        }

        return $this;
    }

    public function removeCommandeClient(CommandeClient $commandeClient): static
    {
        if ($this->commandeClients->removeElement($commandeClient)) {
            $commandeClient->removePlat($this);
        }

        return $this;
    }

    public function isInMenu(): ?bool
    {
        return $this->inMenu;
    }

    public function setInMenu(bool $inMenu): static
    {
        $this->inMenu = $inMenu;

        return $this;
    }
}
