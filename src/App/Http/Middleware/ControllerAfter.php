<?php

namespace LaravelCommon\App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use LaravelCommon\Responses\BaseResponse;

class ControllerAfter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response =  $next($request);

        if ($response instanceof BaseResponse) {
            return $response->send();
        }

        if ($response instanceof Response ||
            $response instanceof JsonResponse) {
            if ($response->exception) {
                throw $response->exception;
            }
        }

        throw new Exception('Controller does not return response');
    }
}
