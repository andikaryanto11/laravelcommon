<?php

namespace LaravelCommon\App\ViewModels;

use LaravelCommon\App\Entities\Groupuser;
use LaravelCommon\App\Entities\User;
use LaravelCommon\ViewModels\AbstractViewModel;
use stdClass;

class UserViewModel extends AbstractViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    /**
     * @var User $entity
     */
    protected $entity;

    /**
     * @inheritdoc
     */
    public function addResource()
    {
        /**
         * @var Groupuser $groupuser
         */
        $groupuser = $this->entity->getGroupuser();
        if (!empty($groupuser)) {
            $this->embedResource('groupuser', new GroupuserViewModel($groupuser, $this->request));
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        return [
            'id' => $this->entity->getId(),
            'username' => $this->entity->getUsername(),
            "is_active" => (bool)$this->entity->getIsActive(),
            "email" => $this->entity->getEmail(),
            "is_deleted" => $this->entity->getIsDeleted(),
            "deleted_at" => $this->entity->getDeletedAt(),
        ];
    }
}
