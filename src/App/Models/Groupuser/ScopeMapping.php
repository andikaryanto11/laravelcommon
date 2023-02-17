<?php

namespace LaravelCommon\App\Models\Groupuser;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LaravelCommon\App\Models\Groupuser;
use LaravelCommon\App\Models\Scope;

class ScopeMapping extends Model
{
    use HasFactory;

    protected $table = 'groupuser_scope_mappings';


    /**
     *
     * @return BelongsTo
     */
    public function groupuser()
    {
        return $this->belongsTo(Groupuser::class);
    }

    /**
     *
     * @return BelongsTo
     */
    public function scope()
    {
        return $this->belongsTo(Scope::class);
    }
}
