<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TBaseRepository")
 */
class TBase
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $DateReception;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Designation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NumerosSerie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TCode", inversedBy="tBases")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CodeComplet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Identification;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TEmplacement", inversedBy="tBases")
     * @ORM\JoinColumn(nullable=false)
     */
    private $emplacement;

    /**
     * @ORM\Column(type="date")
     */
    private $DateAffectation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReception(): ?\DateTimeInterface
    {
        return $this->DateReception;
    }

    public function setDateReception(\DateTimeInterface $DateReception): self
    {
        $this->DateReception = $DateReception;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->Designation;
    }

    public function setDesignation(string $Designation): self
    {
        $this->Designation = $Designation;

        return $this;
    }

    public function getNumerosSerie(): ?string
    {
        return $this->NumerosSerie;
    }

    public function setNumerosSerie(string $NumerosSerie): self
    {
        $this->NumerosSerie = $NumerosSerie;

        return $this;
    }

    public function getCodeComplet(): ?TCode
    {
        return $this->CodeComplet;
    }

    public function setCodeComplet(?TCode $CodeComplet): self
    {
        $this->CodeComplet = $CodeComplet;

        return $this;
    }

    public function __toString()
    {
        return $this->getCodeComplet();
    }

    public function getIdentification(): ?string
    {
        return $this->Identification;
    }

    public function setIdentification(string $Identification): self
    {
        $this->Identification = $Identification;

        return $this;
    }

    public function getEmplacement(): ?TEmplacement
    {
        return $this->emplacement;
    }

    public function setEmplacement(?TEmplacement $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getDateAffectation(): ?\DateTimeInterface
    {
        return $this->DateAffectation;
    }

    public function setDateAffectation(\DateTimeInterface $DateAffectation): self
    {
        $this->DateAffectation = $DateAffectation;

        return $this;
    }
}
