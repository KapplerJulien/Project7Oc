<?php

namespace App\Entity;

use App\Repository\PhoneRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PhoneRepository::class)
 */
class Phone
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"list", "show"})
     */
    private $NamePhone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"list", "show"})
     */
    private $ColorPhone;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"list", "show"})
     */
    private $QuantityPhone;

    /**
     * @ORM\Column(type="float")
     * @Groups({"list", "show"})
     */
    private $PricePhone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"list", "show"})
     */
    private $BrandPhone;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="phones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamePhone(): ?string
    {
        return $this->NamePhone;
    }

    public function setNamePhone(string $NamePhone): self
    {
        $this->NamePhone = $NamePhone;

        return $this;
    }

    public function getColorPhone(): ?string
    {
        return $this->ColorPhone;
    }

    public function setColorPhone(string $ColorPhone): self
    {
        $this->ColorPhone = $ColorPhone;

        return $this;
    }

    public function getQuantityPhone(): ?int
    {
        return $this->QuantityPhone;
    }

    public function setQuantityPhone(int $QuantityPhone): self
    {
        $this->QuantityPhone = $QuantityPhone;

        return $this;
    }

    public function getPricePhone(): ?float
    {
        return $this->PricePhone;
    }

    public function setPricePhone(float $PricePhone): self
    {
        $this->PricePhone = $PricePhone;

        return $this;
    }

    public function getBrandPhone(): ?string
    {
        return $this->BrandPhone;
    }

    public function setBrandPhone(string $BrandPhone): self
    {
        $this->BrandPhone = $BrandPhone;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }
}
