<?php

namespace LaravelCommon\App\Http\Middleware;

use Closure;
use DateTime;
use Exception;
use LaravelCommon\App\Entities\User\Token;
use LaravelCommon\App\Repositories\User\TokenRepository;
use LaravelCommon\Responses\BadRequestResponse;
use LaravelCommon\System\Http\Request;

class CheckToken
{

    /**
     *
     * @var TokenRepository
     */
    protected TokenRepository $tokenRepository;

    /**
     * Undocumented function
     *
     * @param TokenRepository $tokenRepository
     */
    public function __construct(
        TokenRepository $tokenRepository
    )
    {
        $this->tokenRepository = $tokenRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try{
            if($request->hasHeader('Authorization')){
                $authorization = $request->header('Authorization');
                $now = new DateTime();

                $param = [
                    'where' => [
                        ['token', '=', $authorization],
                    ]
                ];

                /**
                 * @var Token $userToken
                 */
                $userToken = $this->tokenRepository->findOne($param);
                if(empty($userToken)){
                    return new BadRequestResponse('Invalid Token');
                }

                if($userToken->getExpiredAt() < $now){
                    return new BadRequestResponse('Token Expired');
                }
                $request->setUserToken($userToken);

            } else {

                return new BadRequestResponse('No Authorization header found');
            }
        } catch(Exception $e){

            return new BadRequestResponse($e->getMessage());
        }
        return $next($request);
    }
}
