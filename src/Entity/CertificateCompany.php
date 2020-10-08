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
 * @ORM\Entity(repositoryClass="App\Repository\CertificateCompanyRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"name","registrationNr"})
 */
class CertificateCompany
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $registrationNr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=1024)
     */
    private $address;

    /**
     * @ORM\Column(type="boolean")
     */
    private $valid = false;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Document", mappedBy="certificateCompany")
     */
    private $documents;

    /**
     * @ORM\Column(type="boolean")
     */
    private $nBody;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $government;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
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

    public function getRegistrationNr(): ?string
    {
        return $this->registrationNr;
    }

    public function setRegistrationNr(string $registrationNr): self
    {
        $this->registrationNr = $registrationNr;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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

    public function getValid(): ?bool
    {
        return $this->valid;
    }

    public function setValid(bool $valid): self
    {
        $this->valid = $valid;

        return $this;
    }

    /**
     * @return Collection|Document[]
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function documentCount()
    {
        return count($this->documents);
    }

    public function addDocument(Document $certificate): self
    {
        if (!$this->documents->contains($certificate)) {
            $this->documents[] = $certificate;
            $certificate->setCertificateCompany($this);
        }

        return $this;
    }

    public function removeDocument(Document $certificate): self
    {
        if ($this->documents->contains($certificate)) {
            $this->documents->removeElement($certificate);
            // set the owning side to null (unless already changed)
            if ($certificate->getCertificateCompany() === $this) {
                $certificate->setCertificateCompany(null);
            }
        }

        return $this;
    }

    public function getNBody(): ?bool
    {
        return $this->nBody;
    }

    public function setNBody(bool $nBody): self
    {
        $this->nBody = $nBody;

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

    public function getGovernment(): ?bool
    {
        return $this->government;
    }

    public function setGovernment(?bool $government): self
    {
        $this->government = $government;

        return $this;
    }
}
