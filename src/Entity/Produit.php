<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[ApiResource]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $price = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column]
    private ?int $minimal_number = null;

    #[ORM\ManyToOne(inversedBy: 'poduits')]
    private ?Fournisseur $Fournisseur = null;

    /**
     * @var Collection<int, Plat>
     */
    #[ORM\ManyToMany(targetEntity: Plat::class, mappedBy: 'composition')]
    private Collection $plats;

    /**
     * @var Collection<int, CommandeFournisseur>
     */
    #[ORM\OneToMany(targetEntity: CommandeFournisseur::class, mappedBy: 'produit')]
    private Collection $commandeFournisseurs;

    public function __construct()
    {
        $this->plats = new ArrayCollection();
        $this->commandeFournisseurs = new ArrayCollection();
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

    public function isPrice(): ?bool
    {
        return $this->price;
    }

    public function setPrice(bool $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getMinimalNumber(): ?int
    {
        return $this->minimal_number;
    }

    public function setMinimalNumber(int $minimal_number): static
    {
        $this->minimal_number = $minimal_number;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->Fournisseur;
    }

    public function setFournisseur(?Fournisseur $Fournisseur): static
    {
        $this->Fournisseur = $Fournisseur;

        return $this;
    }

    /**
     * @return Collection<int, Plat>
     */
    public function getPlats(): Collection
    {
        return $this->plats;
    }

    public function addPlat(Plat $plat): static
    {
        if (!$this->plats->contains($plat)) {
            $this->plats->add($plat);
            $plat->addComposition($this);
        }

        return $this;
    }

    public function removePlat(Plat $plat): static
    {
        if ($this->plats->removeElement($plat)) {
            $plat->removeComposition($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, CommandeFournisseur>
     */
    public function getCommandeFournisseurs(): Collection
    {
        return $this->commandeFournisseurs;
    }

    public function addCommandeFournisseur(CommandeFournisseur $commandeFournisseur): static
    {
        if (!$this->commandeFournisseurs->contains($commandeFournisseur)) {
            $this->commandeFournisseurs->add($commandeFournisseur);
            $commandeFournisseur->setProduit($this);
        }

        return $this;
    }

    public function removeCommandeFournisseur(CommandeFournisseur $commandeFournisseur): static
    {
        if ($this->commandeFournisseurs->removeElement($commandeFournisseur)) {
            // set the owning side to null (unless already changed)
            if ($commandeFournisseur->getProduit() === $this) {
                $commandeFournisseur->setProduit(null);
            }
        }

        return $this;
    }
}
