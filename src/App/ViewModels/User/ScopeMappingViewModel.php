<?php

namespace LaravelCommon\App\ViewModels\User;

use LaravelCommon\App\Entities\User;
use LaravelCommon\App\Entities\User\ScopeMapping;
use LaravelCommon\App\ViewModels\ScopeViewModel;
use LaravelCommon\App\ViewModels\UserViewModel;
use LaravelCommon\ViewModels\AbstractViewModel;
use stdClass;

class ScopeMappingViewModel extends AbstractViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    /**
     * @var ScopeMapping $entity
     */
    protected $entity;

    /**
     * @inheritdoc
     */
    public function addResource()
    {
        $user = $this->entity->getUser();
        if (!empty($user)) {
            $this->embedResource('user', new UserViewModel($user));
        }

        $scope = $this->entity->getScope();
        if (!empty($scope)) {
            $this->embedResource('scope', new ScopeViewModel($scope));
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        return [
            'id' => $this->entity->getId()
        ];
    }
}
