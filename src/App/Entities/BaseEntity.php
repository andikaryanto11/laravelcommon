<?php

namespace LaravelCommon\App\Entities;

use LaravelOrm\Entities\Entity;
use DateTime;
use Exception;
use LaravelCommon\App\Entities\User\Token;

class BaseEntity extends Entity
{
    private int $id = 0;
    private ?string $createdBy = null;
    private ?string $updatedBy = null;
    private ?DateTime $createdAt = null;
    private ?DateTime $updatedAt = null;

    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?string $createdBy)
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function getUpdatedBy(): ?string
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?string $updatedBy)
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    public function getCreatedAt(): ?Datetime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?Datetime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Get the value of id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @inheritdoc
     */
    protected function beforePersist()
    {
        /**
         * @var Token $userToken
         */
        try {
            $userToken = request()->getUserToken();
            if (!empty($userToken)) {

                /**
                 * @var User
                 */
                $user = $userToken->getUser();
                if (!empty($this->getId())) {
                    $this->setUpdatedBy($user->getUsername());
                } else {
                    $this->setCreatedBy($user->getUsername());
                }
            }
        } catch (Exception $e) {
        }
    }
}
