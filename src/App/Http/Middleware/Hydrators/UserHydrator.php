<?php

namespace LaravelCommon\App\Http\Middleware\Hydrators;

use LaravelCommon\App\Http\Middleware\Hydrator;
use LaravelCommon\App\Repositories\GroupuserRepository;
use LaravelCommon\App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function hydrate()
    {
        $this->when('groupuser.id',
            [$this->entity, 'setGroupuser'],
            [$this->groupuserRepository, 'find']
        )->when('username', 
            [$this->entity, 'setUsername']
        )->when('email', 
            [$this->entity, 'setEmail']
        );
    }

    /**
     *
     * @inheritdoc
     */
    public function afterHydrate()
    {
        $input = $this->request->input();
        if(strtoupper($this->request->method()) == 'POST' && isset($input->password)) {
            $this->entity->setPassword(Hash::make($input->password));
        }

        return $this;
    }
}
