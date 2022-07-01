<?php
namespace LaravelCommon\App\Services;

use LaravelCommon\App\Entities\User;
use LaravelCommon\App\Repositories\GroupuserRepository;
use LaravelCommon\App\Repositories\UserRepository;

class UserService {

    /**
     * Undocumented variable
     *
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * Undocumented variable
     *
     * @var GroupuserRepository
     */
    protected GroupuserRepository $groupuserRepository;

    /**
     *
     *
     * @param UserRepository $userRepository
     * @param GroupuserRepository $groupuserRepository
     */
    public function __construct(
        UserRepository $userRepository,
        GroupuserRepository $groupuserRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * generate user token
     *
     * @param string $username
     * @param string $password
     * @return User
     */
    public function generateToken(string $username, string $password){
        $param = [
            'where' => [
                ['Username', '=', 'test' ]
            ]
        ];
        return $this->userRepository->findOne($param);
    }

}
