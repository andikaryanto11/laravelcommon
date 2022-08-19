<?php

namespace LaravelCommon\App\ViewModels;

use LaravelCommon\ViewModels\PaggedCollection;
use LaravelOrm\Interfaces\IEntity;

class GroupuserCollection extends PaggedCollection
{
    /**
     * @inheritdoc
     */
    public function shape(IEntity $entity)
    {
        $this->addItem(new GroupuserViewModel($entity));
    }
}
