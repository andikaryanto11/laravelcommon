<?php

namespace LaravelCommon\App\Entities;

class User extends BaseEntity
{
    /**
     * @var int
     */
    private int $id = 0;

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
    private ?bool $isActive  = null;


    /**
     * @return ?int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return ?Groupuser
     */
    public function getGroupuser(): ?Groupuser
    {
        return $this->groupuser;
    }

    /**
     * @param Groupuser $groupuser
     * @return User
     */
    public function setGroupuser(Groupuser $groupuser): User
    {
        $this->groupuser = $groupuser;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     * @return User
     */
    public function setPhoto(string $photo): User
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     * @return User
     */
    public function setIsActive(bool $isActive): User
    {
        $this->isActive = $isActive;
        return $this;
    }
}
