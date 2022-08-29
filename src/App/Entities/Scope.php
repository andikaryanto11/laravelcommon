<?php

namespace LaravelCommon\App\Entities;

use LaravelOrm\Entities\EntityList;

class Scope extends BaseEntity
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var EntityList
     */
    private ?EntityList $userScopeMappings  = null;

    /**
     * @var EntityList
     */
    private ?EntityList $groupuserScopeMappings  = null;

    /**
     * Get the value of name
     *
     * @return  string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */
    public function setName(string $name): Scope
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of userScopeMappings
     *
     * @return  ?EntityList
     */
    protected function getUserScopeMappings(): ?EntityList
    {
        return $this->userScopeMappings;
    }

    /**
     * Set the value of userScopeMappings
     *
     * @param  EntityList  $userScopeMappings
     *
     * @return  self
     */
    protected function setUserScopeMapppings(EntityList $userScopeMappings): self
    {
        $this->userScopeMappings = $userScopeMappings;

        return $this;
    }

    /**
     * Get the value of groupuserScopeMappings
     *
     * @return  ?EntityList
     */
    protected function getGroupuserScopeMappings(): ?EntityList
    {
        return $this->groupuserScopeMappings;
    }

    /**
     * Set the value of groupuserScopeMappings
     *
     * @param  EntityList  $groupuserScopeMappings
     *
     * @return  self
     */
    protected function setGroupuserScopeMapppings(EntityList $groupuserScopeMappings): self
    {
        $this->groupuserScopeMappings = $groupuserScopeMappings;

        return $this;
    }
}
