<?php

namespace LaravelCommon\App\ViewModels;

use Illuminate\Database\Eloquent\Model;
use LaravelCommon\ViewModels\PaggedCollection;
use LaravelOrm\Interfaces\IEntity;

class ScopeCollection extends PaggedCollection
{
    /**
     * @inheritdoc
     */
    public function shape(Model $model)
    {
        $this->addItem(new ScopeViewModel($model, $this->request));
    }
}
