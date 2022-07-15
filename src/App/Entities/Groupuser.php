<?php

namespace LaravelCommon\App\Entities;

use LaravelOrm\Entities\EntityList;

class Groupuser extends BaseEntity
{
    /**
     * @var int
     */
    private int $id = 0;

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
     * @return ?int
     */
    protected function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $Id
     * @return $this
     */
    protected function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

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
     * @return Groupuser
     */
    protected function setDescription(string $description): Groupuser
    {
        $this->description = $description;
        return $this;
    }
}
