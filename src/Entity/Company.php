<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource()
 * @ORM\Table(schema="med")
 * @ORM\Entity(repositoryClass="App\Repository\CompanyRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"name"})
 */
class Company
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $registrationNr;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="companyId", orphanRemoval=true)
     */
    private $products;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $originalName;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Countries", inversedBy="companies")
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CompanyContacts", mappedBy="company")
     */
    private $companyContacts;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $website;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", mappedBy="manufacturer")
     */
    private $products_manufactured;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CompanyType")
     * @ORM\JoinTable(schema="med",
     *     joinColumns={@ORM\JoinColumn(name="company_id",referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="company_type_id",referencedColumnName="id")}
     * )
     */
    private $companyType;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BlacklistCause")
     */
    private $blacklistCause;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $blacklistedDate;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->companyContacts = new ArrayCollection();
        $this->products_manufactured = new ArrayCollection();
        $this->companyType = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getRegistrationNr(): ?string
    {
        return $this->registrationNr;
    }

    public function setRegistrationNr(string $registrationNr): self
    {
        $this->registrationNr = $registrationNr;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
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
            $product->setCompanyId($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getCompanyId() === $this) {
                $product->setCompanyId(null);
            }
        }

        return $this;
    }

    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    public function setOriginalName(string $originalName): self
    {
        $this->originalName = $originalName;

        return $this;
    }

    public function getCountry(): ?Countries
    {
        return $this->country;
    }

    public function setCountry(?Countries $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|CompanyContacts[]
     */
    public function getCompanyContacts(): Collection
    {
        return $this->companyContacts;
    }

    public function addCompanyContact(CompanyContacts $companyContact): self
    {
        if (!$this->companyContacts->contains($companyContact)) {
            $this->companyContacts[] = $companyContact;
            $companyContact->setCompany($this);
        }

        return $this;
    }

    public function removeCompanyContact(CompanyContacts $companyContact): self
    {
        if ($this->companyContacts->contains($companyContact)) {
            $this->companyContacts->removeElement($companyContact);
            // set the owning side to null (unless already changed)
            if ($companyContact->getCompany() === $this) {
                $companyContact->setCompany(null);
            }
        }

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

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
     * @return Collection|Product[]
     */
    public function getProductsManufactured(): Collection
    {
        return $this->products_manufactured;
    }

    public function addProductsManufactured(Product $productsManufactured): self
    {
        if (!$this->products_manufactured->contains($productsManufactured)) {
            $this->products_manufactured[] = $productsManufactured;
            $productsManufactured->addManufacturer($this);
        }

        return $this;
    }

    public function removeProductsManufactured(Product $productsManufactured): self
    {
        if ($this->products_manufactured->contains($productsManufactured)) {
            $this->products_manufactured->removeElement($productsManufactured);
            $productsManufactured->removeManufacturer($this);
        }

        return $this;
    }

    /**
     * @return Collection|CompanyType[]
     */
    public function getCompanyType(): Collection
    {
        return $this->companyType;
    }

    public function addCompanyType(CompanyType $companyType): self
    {
        if (!$this->companyType->contains($companyType)) {
            $this->companyType[] = $companyType;
        }

        return $this;
    }

    public function removeCompanyType(CompanyType $companyType): self
    {
        if ($this->companyType->contains($companyType)) {
            $this->companyType->removeElement($companyType);
        }

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getBlacklistCause(): ?BlacklistCause
    {
        return $this->blacklistCause;
    }

    public function setBlacklistCause(?BlacklistCause $blacklistCause): self
    {
        $this->blacklistCause = $blacklistCause;

        return $this;
    }

    public function getBlacklistedDate(): ?\DateTimeInterface
    {
        return $this->blacklistedDate;
    }

    public function setBlacklistedDate(?\DateTimeInterface $blacklistedDate): self
    {
        $this->blacklistedDate = $blacklistedDate;

        return $this;
    }
}
