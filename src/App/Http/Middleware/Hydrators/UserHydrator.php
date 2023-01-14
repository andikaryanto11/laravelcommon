<?php

namespace LaravelCommon\App\Http\Middleware\Hydrators;

use App\Repositories\ShopRepository;
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
     *
     * @param GroupuserRepository $groupuserRepository
     */
    public function __construct(
        GroupuserRepository $groupuserRepository
    )
    {
        $this->groupuserRepository = $groupuserRepository;
    }

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

    /**
     * @inheritDoc
     */
    protected function hydrateObjects(array $input) 
    {
        if(array_key_exists('groupuser_id', $input)) {
            $groupuser = $this->groupuserRepository->find($input['groupuser_id']);
            if($groupuser){
                $this->resource->setGroupuser($groupuser);
            }
        }
    }
}
