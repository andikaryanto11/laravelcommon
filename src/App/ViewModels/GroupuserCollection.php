<?php

namespace LaravelCommon\App\ViewModels;

use Illuminate\Database\Eloquent\Model;
use LaravelCommon\App\Models\Groupuser;
use LaravelCommon\ViewModels\PaggedCollection;

class GroupuserCollection extends PaggedCollection
{
    /**
     * @inheritdoc
     */
    public function shape(Model $model): ?GroupuserViewModel
    {
        if ($model instanceof Groupuser) {
            return new GroupuserViewModel($model, $this->request);
        }
    }
}
