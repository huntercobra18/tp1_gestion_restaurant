<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CommandeClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeClientRepository::class)]
#[ApiResource]
class CommandeClient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commandeClients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    /**
     * @var Collection<int, Plat>
     */
    #[ORM\ManyToMany(targetEntity: Plat::class, inversedBy: 'commandeClients')]
    private Collection $plat;

    #[ORM\ManyToOne(inversedBy: 'commandeClients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $serveur = null;

    #[ORM\ManyToOne(inversedBy: 'commandeCook')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $chef = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $ordered_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $prepared_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $served_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $billed_at = null;

    public function __construct()
    {
        $this->plat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, Plat>
     */
    public function getPlat(): Collection
    {
        return $this->plat;
    }

    public function addPlat(Plat $plat): static
    {
        if (!$this->plat->contains($plat)) {
            $this->plat->add($plat);
        }

        return $this;
    }

    public function removePlat(Plat $plat): static
    {
        $this->plat->removeElement($plat);

        return $this;
    }

    public function getServeur(): ?User
    {
        return $this->serveur;
    }

    public function setServeur(?User $serveur): static
    {
        $this->serveur = $serveur;

        return $this;
    }

    public function getChef(): ?User
    {
        return $this->chef;
    }

    public function setChef(?User $chef): static
    {
        $this->chef = $chef;

        return $this;
    }

    public function getOrderedAt(): ?\DateTimeImmutable
    {
        return $this->ordered_at;
    }

    public function setOrderedAt(\DateTimeImmutable $ordered_at): static
    {
        $this->ordered_at = $ordered_at;

        return $this;
    }

    public function getPreparedAt(): ?\DateTimeImmutable
    {
        return $this->prepared_at;
    }

    public function setPreparedAt(?\DateTimeImmutable $prepared_at): static
    {
        $this->prepared_at = $prepared_at;

        return $this;
    }

    public function getServedAt(): ?\DateTimeImmutable
    {
        return $this->served_at;
    }

    public function setServedAt(?\DateTimeImmutable $served_at): static
    {
        $this->served_at = $served_at;

        return $this;
    }

    public function getBilledAt(): ?\DateTimeImmutable
    {
        return $this->billed_at;
    }

    public function setBilledAt(?\DateTimeImmutable $billed_at): static
    {
        $this->billed_at = $billed_at;

        return $this;
    }
}
