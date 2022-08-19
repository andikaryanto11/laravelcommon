<?php

namespace LaravelCommon\App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

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
        $resource->validate();
        
        return $next($request);
    }
}
