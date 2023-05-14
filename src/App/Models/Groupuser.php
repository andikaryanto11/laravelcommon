<?php

namespace LaravelCommon\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LaravelCommon\App\Models\Groupuser\ScopeMapping;

class Groupuser extends Model
{
    use HasFactory;
    use TraitAuditableModel;

    /**
     *
     * @return HasMany
     */
    public function scopeMappings()
    {
        return $this->hasMany(ScopeMapping::class);
    }

    /**
     *
     * @return Collection
     */
    public function getScopeMappings()
    {
        return $this->scopeMappings;
    }

    /**
     * @return string
     */
    public function getGroupName(): string
    {
        return $this->group_name;
    }

    /**
     *
     * @param string $groupname
     * @return Groupuser
     */
    public function setGroupName(string $groupname): Groupuser
    {
        $this->group_name = $groupname;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     *
     * @param string|null $description
     * @return Groupuser
     */
    public function setDescription(?string $description): Groupuser
    {
        $this->description = $description;
        return $this;
    }
}
