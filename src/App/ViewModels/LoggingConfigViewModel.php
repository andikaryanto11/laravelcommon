<?php

namespace LaravelCommon\App\ViewModels;

use LaravelCommon\App\Entities\LoggingConfig;
use LaravelCommon\ViewModels\AbstractViewModel;
use stdClass;

class LoggingConfigViewModel extends AbstractViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    /**
     * @var LoggingConfig $entity
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
            'username' => $this->entity->getName(),
            "is_enabled" => (bool)$this->entity->getIsEnabled()
        ];
    }
}
