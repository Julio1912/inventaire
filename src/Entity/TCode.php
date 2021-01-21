<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TCodeRepository")
 * @UniqueEntity(
 * fields= {"CodeComplet"} , 
 * message="Ce code de produit existe déjà"
 * )
 */
class TCode
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
    private $CodeComplet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Code;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TBase", mappedBy="CodeComplet", orphanRemoval=true)
     */
    private $tBases;

    public function __construct()
    {
        $this->tBases = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeComplet(): ?string
    {
        return $this->CodeComplet;
    }

    public function setCodeComplet(string $CodeComplet): self
    {
        $this->CodeComplet = $CodeComplet;

        return $this;
    }

    public function __toString()
    {
        return $this->getCodeComplet();
    }

    public function getCode(): ?string
    {
        return $this->Code;
    }

    public function setCode(string $Code): self
    {
        $this->Code = $Code;

        return $this;
    }

    /**
     * @return Collection|TBase[]
     */
    public function getTBases(): Collection
    {
        return $this->tBases;
    }

    public function addTBasis(TBase $tBasis): self
    {
        if (!$this->tBases->contains($tBasis)) {
            $this->tBases[] = $tBasis;
            $tBasis->setCodeComplet($this);
        }

        return $this;
    }

    public function removeTBasis(TBase $tBasis): self
    {
        if ($this->tBases->contains($tBasis)) {
            $this->tBases->removeElement($tBasis);
            // set the owning side to null (unless already changed)
            if ($tBasis->getCodeComplet() === $this) {
                $tBasis->setCodeComplet(null);
            }
        }

        return $this;
    }


   
}
