<?php

namespace LaravelCommon\App\Entities;

use LaravelOrm\Entities\EntityList;

class Groupuser extends BaseEntity
{
    /**
     * @var EntityList
     */
    private ?EntityList $users  = null;

    /**
     * @var string
     */
    private ?string $groupname  = null;

    /**
     * @var string
     */
    private ?string $description  = null;

    /**
     * @var EntityList
     */
    private ?EntityList $groupuserScopeMappings  = null;

    /**
     * @return ?EntityList
     */
    protected function getUsers(): ?EntityList
    {
        return $this->users;
    }

    /**
     * @param EntityList $Users
     * @return Groupuser
     */
    protected function setUsers(EntityList $users): Groupuser
    {
        $this->users = $users;
        return $this;
    }

    /**
     * @return ?string
     */
    protected function getGroupname(): ?string
    {
        return $this->groupname;
    }

    /**
     * @param string $groupname
     * @return Groupuser
     */
    protected function setGroupname(string $groupname): Groupuser
    {
        $this->groupname = $groupname;
        return $this;
    }

    /**
     * @return ?string
     */
    protected function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return self
     */
    protected function setDescription(string $description): self
    {
        $this->description = $description;
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
    protected function setGroupuserScopeMappings(EntityList $groupuserScopeMappings): self
    {
        $this->groupuserScopeMappings = $groupuserScopeMappings;

        return $this;
    }
}
