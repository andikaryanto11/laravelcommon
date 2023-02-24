<?php

namespace LaravelCommon\App\Repositories\User;

use LaravelCommon\App\Models\User\ScopeMapping;
use LaravelCommon\App\Repositories\Repository;
use LaravelCommon\App\ViewModels\User\ScopeMappingCollection;
use LaravelCommon\App\ViewModels\User\ScopeMappingViewModel;

class ScopeMappingRepository extends Repository
{
    /**
    * Constrcutor
    */
    public function __construct()
    {
        parent::__construct(ScopeMapping::class);
    }

    /**
     * @inheritDoc
     *
     * @return string
     */
    public function collectionClass(): string
    {
        return ScopeMappingCollection::class;
    }

    /**
     * @inheritDoc
     *
     * @return stirng
     */
    public function viewModelClass(): string
    {
        return ScopeMappingViewModel::class;
    }
}
