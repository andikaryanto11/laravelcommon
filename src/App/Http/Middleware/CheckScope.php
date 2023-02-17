<?php

namespace LaravelCommon\App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use LaravelCommon\App\Consts\ResponseConst;
use LaravelCommon\Responses\BadRequestResponse;
use LaravelCommon\Responses\UnauthorizedResponse;

class CheckScope
{
    public const NAME = 'common.app.middleware.check-scope';

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
        $user = $request->getUserToken()->user;
        $groupuser = $user->groupuser;

        $userScopesMappings = $user->scopeMappings;
        if (count($scopes) > 0) {
            if (!empty($userScopesMappings)) {
                foreach ($userScopesMappings as $userScopesMapping) {
                    $userScope = $userScopesMapping->scope;
                    if (in_array($userScope->name, $scopes) || $userScope->name == 'superadmin') {
                        $isAuthorized = true;
                        break;
                    }
                }
            }

            if (!$isAuthorized && !empty($groupuser)) {
                $groupuserScopeMappings = $groupuser->scopeMappings;
                if (!empty($groupuserScopes)) {
                    foreach ($groupuserScopeMappings as $groupuserScopeMapping) {
                        $groupScope = $groupuserScopeMapping->scope;
                        if (in_array($groupScope->name, $scopes)  || $groupScope->name == 'superadmin') {
                            $isAuthorized = true;
                            break;
                        }
                    }
                }
            }
        } else {
            $isAuthorized = true;
        }

        if (!$isAuthorized) {
            return new UnauthorizedResponse('You are not authorized to view or modify the data', ResponseConst::NOT_AUTHORIZED);
        }


        return $next($request);
    }
}
