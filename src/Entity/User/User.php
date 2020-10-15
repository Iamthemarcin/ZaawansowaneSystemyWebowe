<?php

namespace App\Entity\User;

use App\Entity\Base\Base;
use App\Repository\User\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User extends Base implements UserInterface
{
  /**
   * @ORM\Id()
   * @ORM\GeneratedValue()
   * @ORM\Column(type="integer")
   */
  private ?int $id = null;

  /**
   * @ORM\Column(type="string", length=180)
   */
  private string $email = "";

  /**
   * @ORM\Column(type="string", length=180, nullable=true)
   */
  private string $firstName = "";

  /**
   * @ORM\Column(type="string", length=180, nullable=true)
   */
  private string $lastName = "";
  
  /**
   * @ORM\Column(type="json")
   */
  private array $roles = [];

  /**
   * @var string The hashed password
   * @ORM\Column(type="string")
   */
  private string $password = "";

  /**
   * @ORM\Column(type="boolean")
   */
  private bool $isVerified = false;

  public function getId(): ?int
  {
      return $this->id;
  }

  public function getEmail(): ?string
  {
      return $this->email;
  }

  public function setEmail(string $email): self
  {
      $this->email = $email;

      return $this;
  }

  /**
   * A visual identifier that represents this user.
   *
   * @see UserInterface
   */
  public function getUsername(): string
  {
      return (string) $this->email;
  }

  /**
   * @see UserInterface
   */
  public function getRoles(): array
  {
      $roles = $this->roles;
      // guarantee every user at least has ROLE_USER
      $roles[] = 'ROLE_USER';

      return array_unique($roles);
  }

  public function setRoles(array $roles): self
  {
      $this->roles = $roles;

      return $this;
  }

  /**
   * @see UserInterface
   */
  public function getPassword(): string
  {
      return (string) $this->password;
  }

  public function setPassword(string $password): self
  {
      $this->password = $password;

      return $this;
  }
  
  /**
   * @see UserInterface
   */
  public function getSalt()
  {}

  /**
   * @see UserInterface
   */
  public function eraseCredentials()
  {}

  public function isVerified(): bool
  {
    return $this->isVerified;
  }
  
  public function setIsVerified(bool $isVerified): self
  {
    $this->isVerified = $isVerified;
    
    return $this;
  }
  
  /**
   * @return string
   */
  public function getFirstName(): ?string
  {
    return $this->firstName;
  }
  
  /**
   * @param string $firstName
   *
   * @return User
   */
  public function setFirstName(string $firstName): User
  {
    $this->firstName = $firstName;
    
    return $this;
  }
  
  /**
   * @return string|null
   */
  public function getLastName(): ?string
  {
    return $this->lastName;
  }
  
  /**
   * @param string $lastName
   *
   * @return User
   */
  public function setLastName(string $lastName): User
  {
    $this->lastName = $lastName;
    
    return $this;
  }
}