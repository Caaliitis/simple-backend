<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\StandardRepository")
 * @ORM\Table(schema="med")
 * @ORM\HasLifecycleCallbacks()
 */
class Standard
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", mappedBy="standards")
     */
    private $products;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Countries", inversedBy="standards")
     * @ORM\JoinTable(schema="med",
     *     joinColumns={@ORM\JoinColumn(name="standards_id",referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="country_id",referencedColumnName="id")}
     * )
     */
    private $country;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->country = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
        }

        return $this;
    }


    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->updatedAt = new \DateTime();

        if (!$this->createdAt) {
            $this->createdAt = new \DateTime();
        }
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection|Countries[]
     */
    public function getCountry(): Collection
    {
        return $this->country;
    }

    public function addCountry(Countries $country): self
    {
        if (!$this->country->contains($country)) {
            $this->country[] = $country;
        }

        return $this;
    }

    public function removeCountry(Countries $country): self
    {
        if ($this->country->contains($country)) {
            $this->country->removeElement($country);
        }

        return $this;
    }
}
