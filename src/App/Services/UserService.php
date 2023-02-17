<?php

namespace LaravelCommon\App\Services;

use LaravelCommon\Utilities\Database\ModelUnit;
use DateTime;
use LaravelCommon\App\Models\User;
use Illuminate\Support\Facades\Hash;
use LaravelCommon\App\Queries\UserQuery;
use LaravelOrm\Entities\EntityManager;

class UserService
{
    /**
     * Undocumented variable
     *
     * @var UserQuery
     */
    protected UserQuery $userQuery;

    /**
     * Undocumented variable
     *
     * @var ModelUnit
     */
    protected ModelUnit $modelUnit;

    /**
     * Undocumented variable
     *
     * @var Jwt
     */
    protected Jwt $jwt;

    /**
     *
     *
     * @param UserQuery $userRepository
     * @param ModelUnit $entityManager
     * @param Jwt $jwt
     */
    public function __construct(
        UserQuery $userQuery,
        ModelUnit $modelUnit,
        Jwt $jwt
    ) {
        $this->userQuery = $userQuery;
        $this->modelUnit = $modelUnit;
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

        /**
         * @var User
         */
        $user = $this->userQuery->whereUsername($username)->getIterator()->first();

        if (empty($user)) {
            return null;
        }

        if (!Hash::check($password, $user->password)) {
            return null;
        }

        $userToken = $this->jwt->createUserToken($user);

        $this->modelUnit->preparePersistence($userToken);
        $this->modelUnit->flush();

        return $userToken;
    }
}
