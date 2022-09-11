<?php

namespace LaravelCommon\App\Repositories\User;

use LaravelCommon\App\Entities\User\ScopeMapping;
use LaravelCommon\App\Repositories\Repository;
use LaravelCommon\App\ViewModels\User\ScopeMappingCollection;
use LaravelCommon\App\ViewModels\User\ScopeMappingViewModel;

class ScopeMappingRepository extends Repository implements
    ScopeMappingRepositoryInterface
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
