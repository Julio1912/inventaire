<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TEmplacementRepository")
 * @UniqueEntity(
 * fields= {"Emplacement"} ,
 * message="Cette emplacement existe déjà"
 * )
 */
class TEmplacement
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
    private $Emplacement;

    /**
     * @ORM\Column(type="text" , nullable=true)
     */
    private $Note;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TBase", mappedBy="emplacement", orphanRemoval=true)
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

    public function getEmplacement(): ?string
    {
        return $this->Emplacement;
    }

    public function setEmplacement(string $Emplacement): self
    {
        $this->Emplacement = $Emplacement;

        return $this;
    }

    public function __toString()
    {
        return $this->getEmplacement() ; 
    }

    public function getNote(): ?string
    {
        return $this->Note;
    }

    public function setNote(string $Note): self
    {
        $this->Note = $Note;

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
            $tBasis->setEmplacement($this);
        }

        return $this;
    }

    public function removeTBasis(TBase $tBasis): self
    {
        if ($this->tBases->contains($tBasis)) {
            $this->tBases->removeElement($tBasis);
            // set the owning side to null (unless already changed)
            if ($tBasis->getEmplacement() === $this) {
                $tBasis->setEmplacement(null);
            }
        }

        return $this;
    }
}
