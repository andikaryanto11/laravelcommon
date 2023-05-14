<?php

namespace LaravelCommon\App\Models\Groupuser;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LaravelCommon\App\Models\Groupuser;
use LaravelCommon\App\Models\Scope;
use LaravelCommon\App\Models\TraitAuditableModel;

class ScopeMapping extends Model
{
    use HasFactory;
    use TraitAuditableModel;

    protected $table = 'groupuser_scope_mappings';


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
     * @return BelongsTo
     */
    private function scope()
    {
        return $this->belongsTo(Scope::class);
    }

    /**
     *
     * @return Groupuser
     */
    public function getGroupuser(): Groupuser
    {
        return $this->groupuser;
    }

    /**
     *
     * @param ?Groupuser $groupuser
     * @return ScopeMapping
     */
    public function setGroupuser(?Groupuser $groupuser): ScopeMapping
    {
        $this->groupuser()->associate($groupuser);

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
     * @param ?Scope $groupuser
     * @return ScopeMapping
     */
    public function setScope(?Scope $scope): ScopeMapping
    {
        $this->scope()->associate($scope);

        return $this;
    }
}
