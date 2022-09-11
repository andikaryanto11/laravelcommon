<?php

namespace LaravelCommon\App\Repositories;

use LaravelCommon\App\Entities\Scope;
use LaravelCommon\App\ViewModels\ScopeCollection;
use LaravelCommon\App\ViewModels\ScopeViewModel;
use LaravelOrm\Exception\DatabaseException;
use LaravelOrm\Exception\EntityException;

class ScopeRepository extends Repository implements
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

    /**
     * Undocumented function
     *
     * @param string $name
     * @throws DatabaseException
     * @return Scope
     */
    public function getScopeByName(string $name): Scope
    {
        return $this->findOneOrFail(
            [
                'where' => [
                    ['name', '=', $name]
                ]
            ]
        );
    }
}
