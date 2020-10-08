<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ORM\Table(schema="med")
 * @ORM\HasLifecycleCallbacks()
 */
class Product
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $companyId;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Standard", inversedBy="products")
     * @ORM\JoinTable(schema="med",
     *     joinColumns={@ORM\JoinColumn(name="product_id",referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="standart_id",referencedColumnName="id")}
     * )
     */
    private $standards;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ProductClass", inversedBy="product")
     * @ORM\JoinTable(schema="med",
     *     joinColumns={@ORM\JoinColumn(name="product_id",referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="product_class_id",referencedColumnName="id")}
     * )
     */
    private $productClasses;

    /**
     * @ORM\Column(type="boolean")
     */
    private $FDA_Approved = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $EU_Approved = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $NOISH_Approved = false;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductCategory", inversedBy="product")
     * @ORM\JoinColumn(nullable=false, name="product_category_id")
     */
    private $productCategories;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $sterile;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $valve;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Company", inversedBy="products_manufactured")
     * @ORM\JoinTable(schema="med",
     *     joinColumns={@ORM\JoinColumn(name="product_id",referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="company_id",referencedColumnName="id")}
     * )
     */
    private $manufacturer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Brand")
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nioshApprovalNumber;

    public function __construct()
    {
        $this->standards = new ArrayCollection();
        $this->productClasses = new ArrayCollection();
        $this->manufacturer = new ArrayCollection();
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

    public function getCompanyId(): ?Company
    {
        return $this->companyId;
    }

    public function setCompanyId(?Company $companyId): self
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * @return Collection|Standard[]
     */
    public function getStandards(): Collection
    {
        return $this->standards;
    }

    public function addStandard(Standard $standard): self
    {
        if (!$this->standards->contains($standard)) {
            $this->standards[] = $standard;
            $standard->addProduct($this);
        }

        return $this;
    }

    public function removeStandard(Standard $standard): self
    {
        if ($this->standards->contains($standard)) {
            $this->standards->removeElement($standard);
            $standard->removeProduct($this);
        }

        return $this;
    }

    /**
     * @return Collection|ProductClass[]
     */
    public function getProductClasses(): Collection
    {
        return $this->productClasses;
    }

    public function addProductClass(ProductClass $productClass): self
    {
        if (!$this->productClasses->contains($productClass)) {
            $this->productClasses[] = $productClass;
            $productClass->addProduct($this);
        }

        return $this;
    }

    public function removeProductClass(ProductClass $productClass): self
    {
        if ($this->productClasses->contains($productClass)) {
            $this->productClasses->removeElement($productClass);
            $productClass->removeProduct($this);
        }

        return $this;
    }

    public function getFDAApproved(): ?bool
    {
        return $this->FDA_Approved;
    }

    public function setFDAApproved(bool $FDA_Approved): self
    {
        $this->FDA_Approved = $FDA_Approved;

        return $this;
    }

    public function getEUApproved(): ?bool
    {
        return $this->EU_Approved;
    }

    public function setEUApproved(bool $EU_Approved): self
    {
        $this->EU_Approved = $EU_Approved;

        return $this;
    }

    public function getNOISHApproved(): ?bool
    {
        return $this->NOISH_Approved;
    }

    public function setNOISHApproved(bool $NOISH_Approved): self
    {
        $this->NOISH_Approved = $NOISH_Approved;

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

    public function getProductCategories(): ?ProductCategory
    {
        return $this->productCategories;
    }

    public function setProductCategories(?ProductCategory $productCategory): self
    {
        $this->productCategories = $productCategory;

        return $this;
    }

    public function getSterile(): ?bool
    {
        return $this->sterile;
    }

    public function setSterile(?bool $sterile): self
    {
        $this->sterile = $sterile;

        return $this;
    }

    public function getValve(): ?bool
    {
        return $this->valve;
    }

    public function setValve(?bool $valve): self
    {
        $this->valve = $valve;

        return $this;
    }

    /**
     * @return Collection|Company[]
     */
    public function getManufacturer(): Collection
    {
        return $this->manufacturer;
    }

    public function addManufacturer(Company $manufacturer): self
    {
        if (!$this->manufacturer->contains($manufacturer)) {
            $this->manufacturer[] = $manufacturer;
        }

        return $this;
    }

    public function removeManufacturer(Company $manufacturer): self
    {
        if ($this->manufacturer->contains($manufacturer)) {
            $this->manufacturer->removeElement($manufacturer);
        }

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getNioshApprovalNumber(): ?string
    {
        return $this->nioshApprovalNumber;
    }

    public function setNioshApprovalNumber(?string $nioshApprovalNumber): self
    {
        $this->nioshApprovalNumber = $nioshApprovalNumber;

        return $this;
    }
}
