<?php

namespace LaravelCommon\App\Entities\User;

use LaravelCommon\App\Entities\BaseEntity;
use LaravelCommon\App\Entities\User;
use DateTime;

class Token extends BaseEntity
{
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
     * Get the value of user
     *
     * @return  ?User
     */ 
    protected function getUser(): ?User
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
    protected function setUser(User $user): Token
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of token
     *
     * @return  string
     */ 
    protected function getToken(): string
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
    protected function setToken(string $token): Token
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of expiredAt
     *
     * @return  DateTime
     */ 
    protected function getExpiredAt(): DateTime
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
    protected function setExpiredAt(DateTime $expiredAt): Token
    {
        $this->expiredAt = $expiredAt;

        return $this;
    }

    public function isExpired(){
        $now = new DateTime();
        return $this->getExpiredAt() < $now;
    }
}
