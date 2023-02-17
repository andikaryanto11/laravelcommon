<?php

namespace LaravelCommon\App\ViewModels;

use Illuminate\Database\Eloquent\Model;
use LaravelCommon\App\ViewModels\UserViewModel;
use LaravelCommon\ViewModels\PaggedCollection;
use LaravelOrm\Interfaces\IEntity;

class UserCollection extends PaggedCollection
{
    /**
     * @inheritdoc
     */
    public function shape(Model $model)
    {
        $this->addItem(new UserViewModel($model, $this->request));
    }
}
