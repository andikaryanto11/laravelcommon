<?php

namespace LaravelCommon\App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LaravelCommon\App\Models\User;

class Token extends Model
{
    use HasFactory;


    protected $table = 'user_tokens';

    protected $casts = [
        'expired_at' => 'datetime'
    ];

    /**
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
