<?php

namespace LaravelCommon\App\Entities;

use DateTime;
use Illuminate\Support\Facades\Hash;
use LaravelOrm\Entities\EntityList;

class User extends BaseEntity
{
    /**
     * @var Groupuser
     */
    private ?Groupuser $groupuser  = null;

    /**
     * @var string
     */
    private ?string $username  = null;

    /**
     * @var string
     */
    private ?string $email  = null;

    /**
     * @var string
     */
    private ?string $password  = null;

    /**
     * @var string
     */
    private ?string $photo  = null;

    /**
     * @var bool
     */
    private bool $isActive  = false;

    /**
     * @var EntityList
     */
    private ?EntityList $userScopeMappings  = null;

    /**
     * Undocumented variable
     *
     * @var bool
     */
    private bool $isDeleted = false;

    /**
     * Undocumented variable
     *
     * @var DateTime|null
     */
    private ?DateTime $deletedAt = null;


    /**
     * @return ?Groupuser
     */
    protected function getGroupuser(): ?Groupuser
    {
        return $this->groupuser;
    }

    /**
     * @param Groupuser $groupuser
     * @return User
     */
    protected function setGroupuser(Groupuser $groupuser): User
    {
        $this->groupuser = $groupuser;
        return $this;
    }

    /**
     * @return ?string
     */
    protected function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    protected function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return ?string
     */
    protected function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $username
     * @return User
     */
    protected function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return ?string
     */
    protected function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    protected function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return ?string
     */
    protected function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     * @return User
     */
    protected function setPhoto(string $photo): User
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return ?bool
     */
    protected function getIsActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     * @return User
     */
    protected function setIsActive(bool $isActive): User
    {
        $this->isActive = $isActive;
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
    protected function setUserScopeMappings(EntityList $userScopeMappings): User
    {
        $this->userScopeMappings = $userScopeMappings;

        return $this;
    }

    /**
     * Set the value of realPasword
     *
     * @param  string  $realPasword
     *
     * @return  self
     */
    protected function setRealPassword(string $realPassword)
    {
        $this->password = $realPassword;
        $this->realPassword = $realPassword;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  bool
     */
    protected function getIsDeleted(): bool
    {
        return $this->isDeleted;
    }

    /**
     * Set undocumented variable
     *
     * @param  bool  $isDeleted  Undocumented variable
     *
     * @return  self
     */
    protected function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  DateTime|null
     */
    protected function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * Set undocumented variable
     *
     * @param  DateTime|null  $deletedAt  Undocumented variable
     *
     * @return  self
     */
    protected function setDeletedAt(Datetime $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}
