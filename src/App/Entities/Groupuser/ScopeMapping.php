<?php

namespace LaravelCommon\App\Entities\Groupuser;

use LaravelCommon\App\Entities\BaseEntity;
use LaravelCommon\App\Entities\Scope;
use LaravelCommon\App\Entities\Groupuser;

class ScopeMapping extends BaseEntity
{
    /**
     * Undocumented variable
     *
     * @var Groupuser
     */
    private Groupuser $user;

    /**
     * Undocumented variable
     *
     * @var ?Scope
     */
    private ?Scope $scope = null;

    /**
     * Get undocumented variable
     *
     * @return  Groupuser
     */
    protected function getGroupuser(): Groupuser
    {
        return $this->user;
    }

    /**
     * Set undocumented variable
     *
     * @param  Groupuser  $user  Undocumented variable
     *
     * @return  self
     */
    protected function setGroupuser(Groupuser $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  ?Scope
     */
    protected function getScope(): ?Scope
    {
        return $this->scope;
    }

    /**
     * Set undocumented variable
     *
     * @param  Scope  $scope  Undocumented variable
     *
     * @return  self
     */
    protected function setScope(Scope $scope): self
    {
        $this->scope = $scope;

        return $this;
    }
}
