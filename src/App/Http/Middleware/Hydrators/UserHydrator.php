<?php

namespace LaravelCommon\App\Http\Middleware\Hydrators;

use App\Repositories\ShopRepository;
use LaravelCommon\App\Http\Middleware\Hydrator;
use LaravelCommon\App\Repositories\UserRepository;

class UserHydrator extends Hydrator
{
    public const NAME = 'common.app.middelware.hydrator.user';
    /**
     *
     * @return string
     */
    public function repositoryClass(): string
    {
        return UserRepository::class;
    }

    /**
     * @inheritDoc
     */
    public function getKey(): string
    {
        return 'user';
    }
}
