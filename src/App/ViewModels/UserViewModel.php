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
    public function addResource(array &$element)
    {
        /**
         * @var Groupuser $groupuser
         */
        $groupuser = $this->entity->getGroupuser();
        if (!empty($groupuser)) {
            $element['groupuser'] = (new GroupuserViewModel($groupuser))->toArray();
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
            "is_active" => (bool)$this->entity->getIsActive()
        ];
    }
}
