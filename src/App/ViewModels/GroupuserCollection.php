<?php

namespace LaravelCommon\App\ViewModels;

use LaravelCommon\ViewModels\AbstractCollection;
use LaravelOrm\Interfaces\IEntity;

class GroupuserCollection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    public function shape(IEntity $entity)
    {
        $this->addItem(new GroupuserViewModel($entity));
    }
}
