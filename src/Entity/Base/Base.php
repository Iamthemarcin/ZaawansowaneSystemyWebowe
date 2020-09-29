<?php

namespace App\Entity\Base;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=true, hardDelete=false)
 * @ORM\MappedSuperclass()
 * @ORM\HasLifecycleCallbacks()
 */
class Base
{
  /**
   * @ORM\Column(name="createdAt", type="datetime")
   */
  private ?DateTime $createdAt = null;
  
  /**
   * @ORM\Column(name="updated_at", type="datetime")
   */
  private ?DateTime $updatedAt = null;
  
  /**
   * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
   */
  private ?DateTime $deletedAt = null;
  
  /**
   * @return mixed
   */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }
  
  public function getUpdatedAt()
  {
    return $this->updatedAt;
  }
  
  public function setUpdatedAt($updatedAt)
  {
    $this->updatedAt = $updatedAt;
  }
  
  public function getDeletedAt()
  {
    return $this->deletedAt;
  }
  
  public function setDeletedAt($deletedAt)
  {
    $this->deletedAt = $deletedAt;
  }
  
  public function isDeleted()
  {
    return null !== $this->deletedAt;
  }
  
  /**
   * @ORM\PreUpdate()
   */
  public function preUpdate()
  {
    $this->updatedAt = new DateTime();
  }
  
  /**
   * @ORM\PrePersist()
   */
  public function prePersist()
  {
    $this->createdAt = new DateTime();
    $this->updatedAt = new DateTime();
  }
}