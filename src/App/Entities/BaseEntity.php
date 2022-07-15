<?php

namespace LaravelCommon\App\Entities;

use LaravelOrm\Entities\Entity;
use DateTime;

class BaseEntity extends Entity
{
    private ?string $createdBy = null;
    private ?string $updatedBy = null;
    private ?DateTime $createdAt = null;
    private ?DateTime $updatedAt = null;

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?string $createdBy)
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?string $updatedBy)
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
