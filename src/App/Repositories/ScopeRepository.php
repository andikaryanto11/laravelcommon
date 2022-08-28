<?php

namespace LaravelCommon\App\Repositories;

use LaravelCommon\App\Entities\Scope;
use LaravelCommon\App\ViewModels\ScopeCollection;
use LaravelCommon\App\ViewModels\ScopeViewModel;

class ScopeRepository extends BaseRepository implements
    ScopeRepositoryInterface
{
 /**
    * Constrcutor
    */
    public function __construct()
    {
        parent::__construct(Scope::class);
    }

    /**
     * @inheritDoc
     *
     * @return string
     */
    public function collectionClass(): string
    {
        return ScopeCollection::class;
    }

    /**
     * @inheritDoc
     *
     * @return stirng
     */
    public function viewModelClass(): string
    {
        return ScopeViewModel::class;
    }
}
