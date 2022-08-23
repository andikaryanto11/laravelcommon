<?php

namespace LaravelCommon\App\Services;

use DateTime;
use Firebase\JWT\JWT as JWTJWT;
use LaravelCommon\App\Entities\User;
use LaravelCommon\App\Entities\User\Token;

class Jwt
{
    /**
     * Create user token
     *
     * @param User $user
     * @return Token
     */
    public function createUserToken(User $user): Token
    {
        $jwtExpiredDay = app('config')->get('common-config')['jwt']['expired_in_days'];
        $jwtExpiredDate = new DateTime($jwtExpiredDay . ' days');

        $payload =
            [
                $user->getId(),
                $user->getUsername(),
                $user->getPassword(),
                $jwtExpiredDate->format('YmdHis')
            ];

        $token = JWTJWT::encode($payload, env('APP_KEY'), 'HS256');

        $userToken = new Token();
        $userToken->setUser($user);
        $userToken->setToken($token);
        $userToken->setExpiredAt($jwtExpiredDate);

        return $userToken;
    }
}
