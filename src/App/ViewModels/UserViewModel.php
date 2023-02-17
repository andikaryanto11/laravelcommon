<?php

namespace LaravelCommon\App\ViewModels;

use LaravelCommon\App\Models\Groupuser;
use LaravelCommon\App\Models\User;
use LaravelCommon\ViewModels\AbstractViewModel;
use stdClass;

class UserViewModel extends AbstractViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    /**
     * @var User $model
     */
    protected $model;

    /**
     * @inheritdoc
     */
    public function addResource()
    {
        /**
         * @var Groupuser $groupuser
         */
        $groupuser = $this->model->groupuser;
        if (!empty($groupuser)) {
            $this->embedResource('groupuser', new GroupuserViewModel($groupuser, $this->request));
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        return [
            'username' => $this->model->username,
            "is_active" => (bool)$this->model->is_active,
            "email" => $this->model->email,
            "is_deleted" => $this->model->is_deleted,
            "deleted_at" => $this->model->deleted_at,
        ];
    }
}
