<?php

namespace LaravelCommon\App\Http\Middleware\Hydrators;

use LaravelCommon\App\Http\Middleware\Hydrator;
use LaravelCommon\App\Repositories\GroupuserRepository;
use LaravelCommon\App\Repositories\UserRepository;

class UserHydrator extends Hydrator
{
    public const NAME = 'common.app.middelware.hydrator.user';

    /**
     * @var GroupuserRepository
     */
    protected GroupuserRepository $groupuserRepository;

    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     *
     * @param GroupuserRepository $groupuserRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        GroupuserRepository $groupuserRepository,
        UserRepository $userRepository
    ) {
        parent::__construct('user', $userRepository);
        $this->groupuserRepository = $groupuserRepository;
    }

    /**
     * @inheritDoc
     */
    protected function hydrateObjects()
    {
        return [
            'groupuser_id' => [
                [$this->resource, 'setGroupuser'],
                [$this->groupuserRepository, 'find']
            ]
        ];
    }
}
