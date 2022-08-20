<?php

namespace LaravelCommon\App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use LaravelCommon\Exceptions\ResponsableExeption;
use LaravelCommon\Responses\BadRequestResponse;
use LaravelOrm\Exception\ValidationException;

class ResourceValidation
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
        $resource = $request->getResource();
        try{
            $resource->validate();
        } catch(ValidationException $e){
            throw new ResponsableExeption($e->getMessage(), new BadRequestResponse($e->getMessage()));
        }
        
        return $next($request);
    }
}
