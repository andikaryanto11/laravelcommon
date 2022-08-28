<?php

namespace LaravelCommon\App\ViewModels\User;

use LaravelCommon\App\Entities\User;
use LaravelCommon\App\Entities\User\ScopeMapping;
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
    public function addResource(array &$element)
    {
        $user = $this->entity->getUser();
        if (!empty($user)) {
            $element['user'] = $user;
        }

        $scope = $this->entity->getScope();
        if (!empty($scope)) {
            $element['scope'] = $scope;
        }
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
