<?php

namespace LaravelCommon\App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LaravelCommon\App\Models\User\ScopeMapping;

// use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use TraitAuditableModel;

    protected bool $is_active = true;
    protected bool $is_deleted = false;

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
    protected function groupuser()
    {
        return $this->belongsTo(Groupuser::class);
    }

    /**
     *
     * @return BelongsToMany
     */
    protected function scopes()
    {
        return $this->belongsToMany(Scope::class, 'user_scopes');
    }

    /**
     *
     * @return Collection
     */
    public function getScopes()
    {
        return $this->scopes()->get();
    }

    /**
     *
     * @return Collection
     */
    public function setScopes(Collection $scopes)
    {
        return $this->scopes()->sync($scopes);
    }

    /**
     *
     * @param Scope $scope
     * @return User
     */
    public function addScope(Scope $scope): User
    {
        $this->scopes()->attach($scope);
        return $this;
    }

    /**
     *
     * @param Scope $scope
     * @return User
     */
    public function removeScope(Scope $scope): User
    {
        $this->scopes()->detach($scope);
        return $this;
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
    public function getGroupuser(): ?Groupuser
    {
        return $this->groupuser()->first();
    }

    /**
     *
     * @param Groupuser $groupuser
     * @return $this
     */
    public function setGroupuser(Groupuser $groupuser): User
    {
        $this->groupuser()->associate($groupuser);
        return $this;
    }

    /**
     * Get the value of is_active
     */
    public function getIsDeleted(): bool
    {
        return $this->is_deleted;
    }

    /**
     * Set the value of is_deleted
     *
     * @return  self
     */
    public function setIsDeleted($isDeleted): User
    {
        $this->is_deleted = $isDeleted;

        return $this;
    }

    /**
     *
     * @return ?Carbon
     */
    public function getDeletedAt(): ?Carbon
    {
        return $this->deleted_at;
    }

    /**
     *
     * @param Carbon $deleted_at
     * @return Token
     */
    public function setDeletedAt(Carbon $deletedAt): User
    {
        $this->deleted_at = $deletedAt;
        return $this;
    }
}
