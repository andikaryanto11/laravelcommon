<?php

namespace LaravelCommon\App\ViewModels\User;

use LaravelCommon\ViewModels\PaggedCollection;
use LaravelOrm\Interfaces\IEntity;

class ScopeMappingCollection extends PaggedCollection
{
    /**
     * @inheritdoc
     */
    public function shape(IEntity $entity)
    {
        $this->addItem(new ScopeMappingViewModel($entity, $this->request));
    }
}
