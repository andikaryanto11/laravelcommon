<?php

namespace LaravelCommon\App\Repositories;

use LaravelCommon\App\Entities\User;
use LaravelOrm\Repository\Repository;

class UserRepository extends Repository implements UserRepositoryInterface
{
 /**
    * Constrcutor
    */
    public function __construct()
    {
        parent::__construct(User::class);
    }
}
