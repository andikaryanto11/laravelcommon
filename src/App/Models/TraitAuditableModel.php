<?php

namespace LaravelCommon\App\Models;

use Carbon\Carbon;

trait TraitAuditableModel
{

    /**
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param mixed $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of created_by
     */ 
    public function getCreatedBy(): ?string
    {
        return $this->created_by;
    }

    /**
     * Set the value of created_by
     *
     * @return  self
     */ 
    public function setCreatedBy(?string $createdBy)
    {
        $this->created_by = $createdBy;

        return $this;
    }

    /**
     * Get the value of updated_by
     */ 
    public function getUpdatedBy(): ?string
    {
        return $this->updated_by;
    }

    /**
     * Set the value of updated_by
     *
     * @return  self
     */ 
    public function setUpdatedBy(?string $updatedBy)
    {
        $this->updated_by = $updatedBy;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreatedAtUtc(): ?Carbon
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreatedAtUtc(?Carbon $createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get the value of updated_at
     */ 
    public function getUpdatedAtUtc(): ?Carbon
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */ 
    public function setUpdatedAtUtc(?Carbon $updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }
}
