<?php

namespace LaravelCommon\App\Services;

use DateTime;
use LaravelCommon\App\Entities\User;
use LaravelCommon\App\Repositories\GroupuserRepository;
use LaravelCommon\App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use LaravelCommon\App\Entities\User\Token;
use LaravelOrm\Entities\EntityManager;

class UserService
{
    /**
     * Undocumented variable
     *
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * Undocumented variable
     *
     * @var EntityManager
     */
    protected EntityManager $entityManager;

    /**
     * Undocumented variable
     *
     * @var Jwt
     */
    protected Jwt $jwt;

    /**
     *
     *
     * @param UserRepository $userRepository
     * @param EntityManager $entityManager
     * @param Jwt $jwt
     */
    public function __construct(
        UserRepository $userRepository,
        EntityManager $entityManager,
        Jwt $jwt
    ) {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->jwt = $jwt;
    }

    /**
     * generate user token
     *
     * @param string $username
     * @param string $password
     * @return User
     */
    public function generateToken(string $username, string $password)
    {
        $param = [
            'where' => [
                ['username', '=', $username]
            ]
        ];

        /**
         * @var User
         */
        $user = $this->userRepository->findOne($param);

        if (empty($user)) {
            return null;
        }

        if (!Hash::check($password, $user->getPassword())) {
            return null;
        }

        $userToken = $this->jwt->createUserToken($user);

        $this->entityManager->persist($userToken);

        return $userToken;
    }
}
