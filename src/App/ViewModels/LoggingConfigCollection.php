<?php

namespace LaravelCommon\App\ViewModels;

use Illuminate\Database\Eloquent\Model;
use LaravelCommon\ViewModels\PaggedCollection;
use LaravelOrm\Interfaces\IEntity;

class LoggingConfigCollection extends PaggedCollection
{
    /**
     * @inheritdoc
     */
    public function shape(Model $model)
    {
        $this->addItem(new LoggingConfigViewModel($model, $this->request));
    }
}
