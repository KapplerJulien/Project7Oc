<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $Username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $NameCompany;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AddressCompany;

    /**
     * @ORM\Column(type="integer")
     */
    private $FloorCompany;

    /**
     * @ORM\Column(type="integer")
     */
    private $ZipCodeCompany;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CityCompany;

    /**
     * @ORM\Column(type="integer")
     */
    private $PhoneCompany;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MailCompany;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="company")
     */
    private $users;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Address2Company;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->Username;
    }

    public function setUsername(string $Username): self
    {
        $this->Username = $Username;

        return $this;
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

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getNameCompany(): ?string
    {
        return $this->NameCompany;
    }

    public function setNameCompany(string $NameCompany): self
    {
        $this->NameCompany = $NameCompany;

        return $this;
    }

    public function getAddressCompany(): ?string
    {
        return $this->AddressCompany;
    }

    public function setAddressCompany(string $AddressCompany): self
    {
        $this->AddressCompany = $AddressCompany;

        return $this;
    }

    public function getAddress2Company(): ?string
    {
        return $this->Address2Company;
    }

    public function setAddress2Company(string $Address2Company): self
    {
        $this->Address2Company = $Address2Company;

        return $this;
    }

    public function getFloorCompany(): ?int
    {
        return $this->FloorCompany;
    }

    public function setFloorCompany(int $FloorCompany): self
    {
        $this->FloorCompany = $FloorCompany;

        return $this;
    }

    public function getZipCodeCompany(): ?int
    {
        return $this->ZipCodeCompany;
    }

    public function setZipCodeCompany(int $ZipCodeCompany): self
    {
        $this->ZipCodeCompany = $ZipCodeCompany;

        return $this;
    }

    public function getCityCompany(): ?string
    {
        return $this->CityCompany;
    }

    public function setCityCompany(string $CityCompany): self
    {
        $this->CityCompany = $CityCompany;

        return $this;
    }

    public function getPhoneCompany(): ?int
    {
        return $this->PhoneCompany;
    }

    public function setPhoneCompany(int $PhoneCompany): self
    {
        $this->PhoneCompany = $PhoneCompany;

        return $this;
    }

    public function getMailCompany(): ?string
    {
        return $this->MailCompany;
    }

    public function setMailCompany(string $MailCompany): self
    {
        $this->MailCompany = $MailCompany;

        return $this;
    }

     /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCompany($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCompany() === $this) {
                $user->setCompany(null);
            }
        }

        return $this;
    }
}
