<?php

namespace LaravelCommon\App\Queries;

use Illuminate\Database\ConnectionInterface;
use LaravelCommon\App\Models\LoggingConfig;
use LaravelCommon\App\Queries\Query;
use LaravelCommon\App\ViewModels\LoggingConfigCollection;
use Illuminate\Database\Query\Processors\Processor;
use Illuminate\Database\Query\Grammars\Grammar;

class LoggingConfigQuery extends Query
{
    public function identityClass(): string
    {
        return LoggingConfig::class;
    }

    public function collectionClass()
    {
        return LoggingConfigCollection::class;
    }

    /**
     * find logging by name
     *
     * @param string $name
     * @return $this
     */
    public function whereName(string $name): LoggingConfigQuery
    {
        $this->where('name', '=', $name);
        return $this;
    }

    /**
    * find logging by enabled
    *
    * @return $this
    */
    public function whereIsEnabled(): LoggingConfigQuery
    {
        $this->where('is_enabled', '=', 1);
        return $this;
    }
}
