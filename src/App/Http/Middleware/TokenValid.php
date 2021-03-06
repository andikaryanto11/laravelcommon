<?php

namespace LaravelCommon\App\Http\Middleware;

use App\Entities\User\Token;
use Closure;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use LaravelCommon\App\Repositories\User\TokenRepository;
use LaravelCommon\Responses\BadRequestResponse;
use LaravelCommon\Responses\BaseResponse;

class TokenValid
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try{
            if($request->hasHeader('Authorization')){
                $authorization = $request->header('Authorization');
                $jwtConfig = app('config')->get('jwt');
                $now = new DateTime();

                $param = [
                    'where' => [
                        ['token', '=', $authorization],
                        // ['expired_at', '=', $ninetyDays]
                    ]
                ];

                /**
                 * @var Token $userToken
                 */
                $userToken = $this->tokenRepository->findOne($param);
                if(empty($userToken)){
                    return new BadRequestResponse('Invalid Token', [], []);
                }

                if($userToken->getExpiredAt() < $now){
                    return new BadRequestResponse('Token Expired', [], []);
                }
                $request->userToken = $userToken;

            }
        } catch(Exception $e){

            return new BadRequestResponse($e->getMessage(), [], []);
        }
        return $next($request);
    }
}
