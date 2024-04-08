<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[ApiResource]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $validation_id = null;

    #[ORM\Column]
    private ?int $phone = null;

    #[ORM\Column(length: 500)]
    private ?string $address = null;

    #[ORM\Column(length: 20)]
    private ?string $disponibility = null;

    /**
     * @var Collection<int, CommandeClient>
     */
    #[ORM\OneToMany(targetEntity: CommandeClient::class, mappedBy: 'serveur')]
    private Collection $commandeClients;

    /**
     * @var Collection<int, CommandeClient>
     */
    #[ORM\OneToMany(targetEntity: CommandeClient::class, mappedBy: 'chef')]
    private Collection $commandeCook;

    public function __construct()
    {
        $this->commandeClients = new ArrayCollection();
        $this->commandeCook = new ArrayCollection();
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
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
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

    public function getValidationId(): ?string
    {
        return $this->validation_id;
    }

    public function setValidationId(string $validation_id): static
    {
        $this->validation_id = $validation_id;

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

    public function getDisponibility(): ?string
    {
        return $this->disponibility;
    }

    public function setDisponibility(string $disponibility): static
    {
        $this->disponibility = $disponibility;

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
            $commandeClient->setServeur($this);
        }

        return $this;
    }

    public function removeCommandeClient(CommandeClient $commandeClient): static
    {
        if ($this->commandeClients->removeElement($commandeClient)) {
            // set the owning side to null (unless already changed)
            if ($commandeClient->getServeur() === $this) {
                $commandeClient->setServeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommandeClient>
     */
    public function getCommandeCook(): Collection
    {
        return $this->commandeCook;
    }

    public function addCommandeCook(CommandeClient $commandeCook): static
    {
        if (!$this->commandeCook->contains($commandeCook)) {
            $this->commandeCook->add($commandeCook);
            $commandeCook->setChef($this);
        }

        return $this;
    }

    public function removeCommandeCook(CommandeClient $commandeCook): static
    {
        if ($this->commandeCook->removeElement($commandeCook)) {
            // set the owning side to null (unless already changed)
            if ($commandeCook->getChef() === $this) {
                $commandeCook->setChef(null);
            }
        }

        return $this;
    }
}
