<?php

namespace LaravelCommon\App\ViewModels;

use Illuminate\Database\Eloquent\Model;
use LaravelCommon\App\Models\LoggingConfig;
use LaravelCommon\ViewModels\PaggedCollection;

class LoggingConfigCollection extends PaggedCollection
{
    /**
     * @inheritdoc
     */
    public function shape(Model $model): ?LoggingConfigViewModel
    {
        if ($model instanceof LoggingConfig) {
            return new LoggingConfigViewModel($model, $this->request);
        }
    }
}
