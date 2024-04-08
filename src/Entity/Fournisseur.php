<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
#[ApiResource]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $rib = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $phone = null;

    /**
     * @var Collection<int, Poduit>
     */
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'Fournisseur')]
    private Collection $poduits;

    /**
     * @var Collection<int, CommandeFournisseur>
     */
    #[ORM\OneToMany(targetEntity: CommandeFournisseur::class, mappedBy: 'fournisseur')]
    private Collection $commandes;

    public function __construct()
    {
        $this->poduits = new ArrayCollection();
        $this->commandes = new ArrayCollection();
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

    public function getRib(): ?string
    {
        return $this->rib;
    }

    public function setRib(string $rib): static
    {
        $this->rib = $rib;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection<int, Poduit>
     */
    public function getPoduits(): Collection
    {
        return $this->poduits;
    }

    public function addPoduit(Produit $poduit): static
    {
        if (!$this->poduits->contains($poduit)) {
            $this->poduits->add($poduit);
            $poduit->setFournisseur($this);
        }

        return $this;
    }

    public function removePoduit(Produit $poduit): static
    {
        if ($this->poduits->removeElement($poduit)) {
            // set the owning side to null (unless already changed)
            if ($poduit->getFournisseur() === $this) {
                $poduit->setFournisseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommandeFournisseur>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(CommandeFournisseur $commande): static
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->setFournisseur($this);
        }

        return $this;
    }

    public function removeCommande(CommandeFournisseur $commande): static
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getFournisseur() === $this) {
                $commande->setFournisseur(null);
            }
        }

        return $this;
    }
}
