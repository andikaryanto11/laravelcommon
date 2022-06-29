<?php

namespace LaravelCommon\App\Entities\User;

use LaravelCommon\App\Entities\BaseEntity;
use LaravelCommon\App\Entities\User;
use DateTime;

class Token extends BaseEntity
{
    /**
     * @var int
     */
    private int $id = 0;

    /**
     * @var ?User
     */
    private ?User $user  = null;

    /**
     * @var string
     */
    private ?string $token  = null;

    /**
     * @var DateTime
     */
    private ?DateTime $expiredAt  = null;

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id): Token
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of user
     *
     * @return  User
     */ 
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @param  User  $user
     *
     * @return  self
     */ 
    public function setUser(User $user): Token
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of token
     *
     * @return  string
     */ 
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @param  string  $token
     *
     * @return  self
     */ 
    public function setToken(string $token): Token
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of expiredAt
     *
     * @return  DateTime
     */ 
    public function getExpiredAt(): DateTime
    {
        return $this->expiredAt;
    }

    /**
     * Set the value of expiredAt
     *
     * @param  DateTime  $expiredAt
     *
     * @return  self
     */ 
    public function setExpiredAt(DateTime $expiredAt): Token
    {
        $this->expiredAt = $expiredAt;

        return $this;
    }
}
