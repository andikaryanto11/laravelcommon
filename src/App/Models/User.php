<?php

namespace LaravelCommon\App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LaravelCommon\App\Models\User\ScopeMapping;
use TraitAuditableModel;

// use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use TraitAuditableModel;

    protected string $username;
    // protected Groupuser $groupuser;
    protected string $email;
    protected string $password;
    protected ?string $photo = null;
    protected bool $is_active = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     *
     * @return BelongsTo
     */
    private function groupuser()
    {
        return $this->belongsTo(Groupuser::class);
    }

    /**
     *
     * @return HasMany
     */
    private function scopeMappings()
    {
        return $this->hasMany(ScopeMapping::class);
    }

    /**
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     *
     * @param string|null $username
     * @return $this
     */
    public function setUsername(?string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail(string $email): User
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword(string $password): User
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of is_active
     */ 
    public function getIsActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Set the value of is_active
     *
     * @return  self
     */ 
    public function setIsActive($isActive): User
    {
        $this->is_active = $isActive;

        return $this;
    }

    /**
     *
     * @return void
     */
    public function getGroupuser()
    {
        $this->groupuser;
    }

    public function setGroupuser(Groupuser $groupuser)
    {
        $this->groupuser()->associate($groupuser);
    }
}
