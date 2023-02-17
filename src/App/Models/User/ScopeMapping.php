<?php

namespace LaravelCommon\App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LaravelCommon\App\Models\Scope;
use LaravelCommon\App\Models\User;

class ScopeMapping extends Model
{
    use HasFactory;

    protected $table = 'user_scope_mappings';


    /**
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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
