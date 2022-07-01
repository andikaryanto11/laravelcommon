<?php
namespace LaravelCommon\App\Services;

use DateTime;
use LaravelCommon\App\Entities\User;
use LaravelCommon\App\Repositories\GroupuserRepository;
use LaravelCommon\App\Repositories\UserRepository;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;
use LaravelCommon\App\Entities\User\Token;
use LaravelOrm\Entities\EntityManager;

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
     * Undocumented variable
     *
     * @var EntityManager
     */
    protected EntityManager $entityManager;

    /**
     *
     *
     * @param UserRepository $userRepository
     * @param GroupuserRepository $groupuserRepository
     * @param EntityManager $entityManager
     */
    public function __construct(
        UserRepository $userRepository,
        GroupuserRepository $groupuserRepository,
        EntityManager $entityManager
    )
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
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
                ['username', '=', $username ]
            ]
        ];

        /**
         * @var User
         */
        $user = $this->userRepository->findOne($param);

        if(!Hash::check($password, $user->getPassword())){
            return null;
        }

        $payload = 
        [
            $user->getId(),
            $user->getUsername(),
            $user->getPassword()
        ];

        $token = JWT::encode($payload, env('APP_KEY'), 'HS256');
        $jwtExpiredDay = app('config')->get('jwt')['expired_in_days'];
        $jwtExpiredDate = new DateTime($jwtExpiredDay . ' days');

        $userToken = new Token();
        $userToken->setUser($user);
        $userToken->setToken($token);
        $userToken->setExpiredAt($jwtExpiredDate);

        $this->entityManager->persist($userToken);

        return $userToken;


    }

}
