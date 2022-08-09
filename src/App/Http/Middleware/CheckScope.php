<?php

namespace LaravelCommon\App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use LaravelCommon\Responses\BadRequestResponse;

class CheckScope
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$scopes)
    {
        $isAuthorized = false;
        $user = $request->userToken->getUser();
        $groupuser = $user->getGroupuser();

        $userScopes = $user->getScopes();
        foreach ($userScopes as $userScope) {
            $scope = $userScope->getScope();
            if (in_array($scope->getName(), $scopes)) {
                $isAuthorized = true;
                break;
            }
        }

        if (!$isAuthorized) {
            $groupuserScopes = $groupuser->getScopes();
            foreach ($groupuserScopes as $groupuserScope) {
                $scope = $groupuserScope->getScope();
                if (in_array($scope->getName(), $scopes)) {
                    $isAuthorized = true;
                    break;
                }
            }
        }

        if(!$isAuthorized){
            return new BadRequestResponse('You are not authorized, scope not match');
        }


        return $next($request);
    }
}
