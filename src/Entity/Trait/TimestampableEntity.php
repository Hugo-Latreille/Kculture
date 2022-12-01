<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Annotation\Groups;

trait TimestampableEntity
{

  #[ORM\Column(type: Types::DATETIMETZ_MUTABLE)]
  #[Groups(['answer:read', 'get:Users', 'media:read', 'question:read'])]
  private ?\DateTimeInterface $created_at = null;

  #[ORM\Column(type: Types::DATETIMETZ_MUTABLE)]
  #[Groups(['answer:read', 'get:Users', 'media:read', 'question:read'])]
  private ?\DateTimeInterface $updated_at = null;

  public function getCreatedAt(): ?\DateTimeInterface
  {
    return $this->created_at;
  }

  public function setCreatedAt(\DateTimeInterface $created_at): self
  {
    $this->created_at = $created_at;

    return $this;
  }

  public function getUpdatedAt(): ?\DateTimeInterface
  {
    return $this->updated_at;
  }

  public function setUpdatedAt(\DateTimeInterface $updated_at): self
  {
    $this->updated_at = $updated_at;

    return $this;
  }

  // !TEST
  #[ORM\PrePersist]
  #[ORM\PreUpdate]
  public function updatedTimestamps()
  {
    $this->setUpdatedAt(new \DateTime('now'));

    if ($this->getCreatedAt() == null) {
      $this->setCreatedAt(new \DateTime('now'));
    }
  }
}