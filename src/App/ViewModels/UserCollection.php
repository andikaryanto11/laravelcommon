<?php

namespace LaravelCommon\App\ViewModels;

use LaravelCommon\App\ViewModels\UserViewModel;
use LaravelCommon\ViewModels\PaggedCollection;
use LaravelOrm\Interfaces\IEntity;

class UserCollection extends PaggedCollection
{
    /**
     * @inheritdoc
     */
    public function shape(IEntity $entity)
    {
        $this->addItem(new UserViewModel($entity));
    }
}
