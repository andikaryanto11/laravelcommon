<?php

namespace LaravelCommon\App\ViewModels;

use LaravelCommon\App\Models\Groupuser;
use LaravelCommon\ViewModels\AbstractViewModel;

class GroupuserViewModel extends AbstractViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    /**
     * @var Groupuser
     */
    protected $model;

    /**
     * @inheritdoc
     */
    public function addResource()
    {

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        return [
            'id' => $this->model->getId(),
            'group_name' => $this->model->getGroupName(),
            'description' => $this->model->getDescription()
        ];
    }
}
