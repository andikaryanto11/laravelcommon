<?php

namespace LaravelCommon\App\Repositories;

use LaravelCommon\App\Entities\Groupuser;
use LaravelCommon\App\ViewModels\GroupuserCollection;
use LaravelCommon\App\ViewModels\GroupuserViewModel;

class GroupuserRepository extends BaseRepository implements
    GroupuserRepositoryInterface
{
    /**
    * Constrcutor
    */
    public function __construct()
    {
        parent::__construct(Groupuser::class);
    }

    /**
     * @inheritDoc
     *
     * @return string
     */
    public function collectionClass(): string
    {
        return GroupuserCollection::class;
    }

    /**
     * @inheritDoc
     *
     * @return stirng
     */
    public function viewModelClass(): string
    {
        return GroupuserViewModel::class;
    }
}
