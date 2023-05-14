<?php

namespace LaravelCommon\App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LaravelCommon\App\Models\Scope;
use LaravelCommon\App\Models\TraitAuditableModel;
use LaravelCommon\App\Models\User;

class ScopeMapping extends Model
{
    use HasFactory;
    use TraitAuditableModel;

    protected $table = 'user_scope_mappings';

    /**
     *
     * @return BelongsTo
     */
    private function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     * @return BelongsTo
     */
    private function scope()
    {
        return $this->belongsTo(Scope::class);
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
     * @param ?User $user
     * @return ScopeMapping
     */
    public function setUser(?User $user): ScopeMapping
    {
        $this->user()->associate($user);

        return $this;
    }

    /**
     *
     * @return Scope
     */
    public function getScope(): Scope
    {
        return $this->scope;
    }

    /**
     *
     * @param ?Scope $user
     * @return ScopeMapping
     */
    public function setScope(?Scope $scope): ScopeMapping
    {
        $this->scope()->associate($scope);

        return $this;
    }
}
