<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(schema="med", name="countries")
 * @ORM\Entity(repositoryClass="App\Repository\CountriesRepository")
 * @UniqueEntity("country", message="The field name must be unique")
 */
class Countries
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2)
     * @Assert\Length(
     *     max="2", maxMessage="Use only 2 chars for this field",
     *     min="2", minMessage="Use only 2 chars for this field"
     * )
     */
    private $iso_3166_alpha2;

    /**
     * @ORM\Column(type="string", length=3)
     * @Assert\Length(
     *     max="3", maxMessage="Use only 3 chars for this field",
     *     min="3", minMessage="Use only 3 chars for this field"
     * )
     */
    private $iso_3166_alpha3;

    /**
     * @ORM\Column(type="integer")
     */
    private $iso_3166_numeric;

    /**
     * @ORM\Column(type="string", length=2)
     * @Assert\Length(
     *     max="2", maxMessage="Use only 2 chars for this field",
     *     min="2", minMessage="Use only 2 chars for this field"
     * )
     */
    private $fips;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=2)
     * @Assert\Length(
     *     max="2", maxMessage="Use only 2 chars for this field",
     *     min="2", minMessage="Use only 2 chars for this field"
     * )
     */
    private $continent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Company", mappedBy="country")
     */
    private $companies;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Standard", mappedBy="country")
     */
    private $standards;

    public function __construct()
    {
        $this->companies = new ArrayCollection();
        $this->standards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIso3166Alpha2(): ?string
    {
        return $this->iso_3166_alpha2;
    }

    public function setIso3166Alpha2(string $iso_3166_alpha2): self
    {
        $this->iso_3166_alpha2 = $iso_3166_alpha2;

        return $this;
    }

    public function getIso3166Alpha3(): ?string
    {
        return $this->iso_3166_alpha3;
    }

    public function setIso3166Alpha3(string $iso_3166_alpha3): self
    {
        $this->iso_3166_alpha3 = $iso_3166_alpha3;

        return $this;
    }

    public function getIso3166Numeric(): ?int
    {
        return $this->iso_3166_numeric;
    }

    public function setIso3166Numeric(int $iso_3166_numeric): self
    {
        $this->iso_3166_numeric = $iso_3166_numeric;

        return $this;
    }

    public function getFips(): ?string
    {
        return $this->fips;
    }

    public function setFips(string $fips): self
    {
        $this->fips = $fips;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getContinent(): ?string
    {
        return $this->continent;
    }

    public function setContinent(string $continent): self
    {
        $this->continent = $continent;

        return $this;
    }

    /**
     * @SerializedName("name")
     */
    public function getName()
    {
        return $this->country;
    }

    /**
     * @return Collection|Company[]
     */
    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    public function addCompany(Company $company): self
    {
        if (!$this->companies->contains($company)) {
            $this->companies[] = $company;
            $company->setCountry($this);
        }

        return $this;
    }

    public function removeCompany(Company $company): self
    {
        if ($this->companies->contains($company)) {
            $this->companies->removeElement($company);
            // set the owning side to null (unless already changed)
            if ($company->getCountry() === $this) {
                $company->setCountry(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->country;
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
            $standard->addCountry($this);
        }

        return $this;
    }

    public function removeStandard(Standard $standard): self
    {
        if ($this->standards->contains($standard)) {
            $this->standards->removeElement($standard);
            $standard->removeCountry($this);
        }

        return $this;
    }
}
