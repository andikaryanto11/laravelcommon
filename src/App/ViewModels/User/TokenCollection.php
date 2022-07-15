<?php

namespace LaravelCommon\App\ViewModels\User;

use LaravelCommon\App\ViewModels\UserViewModel;
use LaravelCommon\ViewModels\AbstractCollection;
use LaravelOrm\Interfaces\IEntity;

class TokenCollection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    public function shape(IEntity $entity)
    {
        $this->addItem(new TokenViewModel($entity));
    }
}
