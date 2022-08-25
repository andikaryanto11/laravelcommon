<?php

namespace LaravelCommon\App\Entities;

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
    private ?string $realPassword = null;

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
    private ?EntityList $scopes  = null;

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
     * Get the value of scopes
     *
     * @return  ?EntityList
     */ 
    protected function getScopes(): ?EntityList
    {
        return $this->scopes;
    }

    /**
     * Set the value of scopes
     *
     * @param  EntityList  $scopes
     *
     * @return  self
     */ 
    protected function setScopes(EntityList $scopes): User
    {
        $this->scopes = $scopes;

        return $this;
    }

    /**
     * @inheritdoc
     */
    protected function beforePersist()
    {
        parent::beforePersist();
        if(!empty($this->realPasword)){
            $this->setPassword(Hash::make($this->realPasword));
        }
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
}
