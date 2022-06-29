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
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $Id
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return ?EntityList
     */
    public function getUsers(): ?EntityList
    {
        return $this->users;
    }

    /**
     * @param EntityList $Users
     * @return Groupuser
     */
    public function setUsers(EntityList $users): Groupuser
    {
        $this->users = $users;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getGroupname(): ?string
    {
        return $this->groupname;
    }

    /**
     * @param string $groupname
     * @return Groupuser
     */
    public function setGroupname(string $groupname): Groupuser
    {
        $this->groupname = $groupname;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Groupuser
     */
    public function setDescription(string $description): Groupuser
    {
        $this->description = $description;
        return $this;
    }
}
