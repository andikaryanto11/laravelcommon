<?php

namespace LaravelCommon\App\ViewModels;

use LaravelCommon\App\Entities\Groupuser;
use LaravelCommon\ViewModels\AbstractViewModel;
use LaravelOrm\Entities\EntityList;
use stdClass;

class GroupuserViewModel extends AbstractViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    /**
     * @var Groupuser
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
            'groupname' => $this->entity->getGroupname()
        ];
    }
}
