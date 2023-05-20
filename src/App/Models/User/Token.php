<?php

namespace LaravelCommon\App\Models\User;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LaravelCommon\App\Models\TraitModel;
use LaravelCommon\App\Models\User;

class Token extends Model
{
    use HasFactory;
    use TraitModel;


    protected $table = 'user_tokens';

    protected $casts = [
        'expired_at' => 'datetime'
    ];

    /**
     *
     * @return BelongsTo
     */
    protected function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     *
     * @param User $user
     * @return void
     */
    public function setUser(User $user): Token
    {
        $this->user()->associate($user);
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     *
     * @param string $token
     * @return Token
     */
    public function setToken(string $token): Token
    {
        $this->token = $token;
        return $this;
    }

    /**
     *
     * @return Carbon
     */
    public function getExpiredAt(): Carbon
    {
        return $this->expired_at;
    }

    /**
     *
     * @param Carbon $expiredAt
     * @return Token
     */
    public function setExpiredAt(Carbon $expiredAt): Token
    {
        $this->expired_at = $expiredAt;
        return $this;
    }
}
