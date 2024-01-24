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
    public function identityClass(): string
    {
        return Token::class;
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
