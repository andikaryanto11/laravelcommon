<?php

namespace LaravelCommon\App\Repositories\User;

use LaravelCommon\App\Entities\User\Token;
use LaravelOrm\Repository\Repository;

class TokenRepository extends Repository implements TokenRepositoryInterface
{
    /**
    * Constrcutor
    */
    public function __construct()
    {
        parent::__construct(Token::class);
    }
}
