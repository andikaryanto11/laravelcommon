<?php

namespace LaravelCommon\App\Queries;

use LaravelCommon\App\Queries\Query;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Query\Processors\Processor;
use Illuminate\Database\Query\Grammars\Grammar;
use LaravelCommon\App\Models\Scope;
use LaravelCommon\App\ViewModels\ScopeCollection;

class ScopeQuery extends Query
{
    public function identityClass(): string
    {
        return Scope::class;
    }

    public function collectionClass()
    {
        return ScopeCollection::class;
    }

    /**
     * Undocumented function
     *
     * @param string $name
     * @throws DatabaseException
     * @return ScopeQuery
     */
    public function whereName(string $name): ScopeQuery
    {
        $this->where('name', '=', $name);
        return $this;
    }
}
