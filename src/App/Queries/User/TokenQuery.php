<?php

namespace LaravelCommon\App\Queries\User;

use Illuminate\Database\ConnectionInterface;
use LaravelCommon\App\Models\LoggingConfig;
use LaravelCommon\App\Queries\Query;
use LaravelCommon\App\ViewModels\LoggingConfigCollection;
use Illuminate\Database\Query\Processors\Processor;
use Illuminate\Database\Query\Grammars\Grammar;
use LaravelCommon\App\Models\User\Token;
use LaravelCommon\App\ViewModels\User\TokenCollection;

class TokenQuery extends Query
{
    /**
     * Create a new query builder instance.
     *
     * @param  Token  $token
     * @param  \Illuminate\Database\ConnectionInterface  $connection
     * @param  \Illuminate\Database\Query\Grammars\Grammar|null  $grammar
     * @param  \Illuminate\Database\Query\Processors\Processor|null  $processor
     * @return void
     */
    public function __construct(
        Token $token
    ) {
        parent::__construct($token);
    }

    public function collectionClass()
    {
        return TokenCollection::class;
    }

    /**
     * find logging by name
     *
     * @param string $name
     * @return $this
     */
    public function whereToken(string $token): TokenQuery
    {
        $this->where('token', '=', $token);
        return $this;
    }
}
