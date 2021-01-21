<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 * @UniqueEntity(
 * fields={"Username"} , 
 * message="Ce nom d'utilisateur est déjà utilisé "
 * )
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="2" , minMessage="Le nom d'utilisateur doit contenir au moins 3 caractère")
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255 , unique=true)
     * @Assert\Length(min="3" , minMessage="Le nom d'utilisateur doit contenir au moins 3 caractère")
     */
    private $Username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Password;

    /**
     * @Assert\EqualTo(propertyPath="Password" , message="Lemot de passe est différent")
     */
    public $confirm_password;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->Username;
    }

    public function setUsername(string $Username): self
    {
        $this->Username = $Username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        if(empty($this->roles)){
            $roles[]= "ROLE_USER";
        }
        return $roles;
    }
    public function setRoles($roles)
    {
        $this->roles[]=current($roles);
    }

    public function addRole($role)
    {
        $this->roles[] = $role;
    }

    // function __ToString()
    // {
    //     return $this->getRoles();
    // }

    public function eraseCredentials(){}
    
    public function getSalt(){
        return null;
    }

}
