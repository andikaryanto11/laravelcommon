<?php

namespace LaravelCommon\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelCommon\App\Models\Groupuser\ScopeMapping as GroupuserScopeMapping;
use LaravelCommon\App\Models\User\ScopeMapping;

class Scope extends Model
{
    use HasFactory;


    /**
     *
     * @return HasMany
     */
    public function userScopeMappings()
    {
        return $this->hasMany(ScopeMapping::class);
    }
    /**
     *
     * @return HasMany
     */
    public function groupuserScopeMappings()
    {
        return $this->hasMany(GroupuserScopeMapping::class);
    }
}
