<?php

namespace LaravelCommon\App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use LaravelCommon\App\Consts\ResponseConst;
use LaravelCommon\Responses\JsonResponse;
use LaravelCommon\System\Http\Request;

class RequestValidatorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $rule)
    {
        $rules = $this->$rule();
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return new JsonResponse(
                'invalid request data',
                Response::HTTP_BAD_REQUEST,
                ResponseConst::INVALID_DATA,
                $validator->errors()->getMessages()
            );
        }

        return $next($request);
    }
}
