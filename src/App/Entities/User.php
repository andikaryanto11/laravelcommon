<?php

namespace LaravelCommon\App\Entities;

use DateTime;
use Illuminate\Support\Facades\Hash;
use LaravelOrm\Entities\EntityList;

class User extends BaseEntity
{

    /**
     * @var string
     */
    private ?string $user  = null;

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
    private ?string $role  = null;

    /**
     * @var string
     */
    private ?string $rememberToken  = null;

    /**
     * @var DateTime
     */
    private ?DateTime $emailVerifiedAt  = null;


    /**
     * @return ?string
     */
    protected function getUser(): ?string
    {
        return $this->user;
    }

    /**
     * @param string $user
     * @return User
     */
    protected function setUser(string $user): User
    {
        $this->user = $user;
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
    protected function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @return User
     */
    protected function setRole(string $role): User
    {
        $this->role = $role;
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
     * Get the value of rememberToken
     *
     * @return  string
     */ 
    public function getRememberToken()
    {
        return $this->rememberToken;
    }

    /**
     * Set the value of rememberToken
     *
     * @param  string  $rememberToken
     *
     * @return  self
     */ 
    public function setRememberToken(string $rememberToken)
    {
        $this->rememberToken = $rememberToken;

        return $this;
    }

    /**
     * Get the value of emailVerifiedAt
     *
     * @return  DateTime
     */ 
    public function getEmailVerifiedAt()
    {
        return $this->emailVerifiedAt;
    }

    /**
     * Set the value of emailVerifiedAt
     *
     * @param  DateTime  $emailVerifiedAt
     *
     * @return  self
     */ 
    public function setEmailVerifiedAt(DateTime $emailVerifiedAt)
    {
        $this->emailVerifiedAt = $emailVerifiedAt;

        return $this;
    }
}
