<?php

namespace LaravelCommon\App\Http\Middleware\Hydrators;

use App\Repositories\ShopRepository;
use LaravelCommon\App\Http\Middleware\Hydrator;
use LaravelCommon\App\Repositories\UserRepository;

class UserHydrator extends Hydrator
{
    /**
     *
     * @return string
     */
    public function repositoryClass(): string
    {
        return UserRepository::class;
    }
}
