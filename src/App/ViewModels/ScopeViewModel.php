<?php

namespace LaravelCommon\App\ViewModels;

use LaravelCommon\App\Entities\Scope;
use LaravelCommon\ViewModels\AbstractViewModel;

class ScopeViewModel extends AbstractViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    /**
     * @var Scope $entity
     */
    protected $entity;

    /**
     * @inheritdoc
     */
    public function addResource()
    {
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        return [
            'id' => $this->entity->getId(),
            'name' => $this->entity->getName()
        ];
    }
}
