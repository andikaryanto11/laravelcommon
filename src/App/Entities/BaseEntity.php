<?php

namespace LaravelCommon\App\Entities;

use LaravelOrm\Entities\Entity;
use DateTime;

class BaseEntity extends Entity
{
    private int $id = 0;
    private ?string $createdBy = null;
    private ?string $updatedBy = null;
    private ?DateTime $createdAt = null;
    private ?DateTime $updatedAt = null;

    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?string $createdBy)
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function getUpdatedBy(): ?string
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?string $updatedBy)
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    public function getCreatedAt(): ?Datetime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?Datetime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Get the value of id
     * @return int 
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }
}
