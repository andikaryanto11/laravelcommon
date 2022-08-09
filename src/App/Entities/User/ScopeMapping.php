<?php

namespace LaravelCommon\App\Entities\User;

use LaravelCommon\App\Entities\BaseEntity;
use LaravelCommon\App\Entities\Scope;
use LaravelCommon\App\Entities\User;

class ScopeMapping extends BaseEntity {
    /**
     * Undocumented variable
     *
     * @var User
     */
    private User $user;

    /**
     * Undocumented variable
     *
     * @var Scope
     */
    private Scope $scope;

    /**
     * Get undocumented variable
     *
     * @return  User
     */ 
    protected function getUser(): User
    {
        return $this->user;
    }

    /**
     * Set undocumented variable
     *
     * @param  User  $user  Undocumented variable
     *
     * @return  self
     */ 
    protected function setUser(User $user): ScopeMapping
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  Scope
     */ 
    protected function getScope(): Scope
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
    protected function setScope(Scope $scope): ScopeMapping
    {
        $this->scope = $scope;

        return $this;
    }
}