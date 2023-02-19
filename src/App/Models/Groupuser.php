<?php

namespace LaravelCommon\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use LaravelCommon\App\Models\Groupuser\ScopeMapping;

class Groupuser extends Model
{
    use HasFactory;

    /**
     *
     * @return HasMany
     */
    public function scopeMappings()
    {
        return $this->hasMany(ScopeMapping::class);
    }
}
