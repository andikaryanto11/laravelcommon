<?php

namespace LaravelCommon\App\Http\Middleware;

use Closure;
use Exception;
use LaravelCommon\System\Http\Request;

class Hydrator
{

    /**
     * Undocumented function
     *
     * @return string
     */
    public function entityClass(): string
    {
        throw new Exception('"entityClass" needs to be overriden on your hydrator classes');
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function repositoryClass(): string
    {
        throw new Exception('"repositoryClass" needs to be overriden on your hydrator classes');
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$methods)
    {
        $mehod = $methods[0];
        if ($mehod == 'post') {
            $this->post($request);
        }

        if ($mehod == 'get') {
            $this->get($request);
        }

        return $next($request);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function get(Request $request)
    {
        $id = $request->route()->parameter('id');
        $repositoryClass = $this->repositoryClass();
        $entityClass = $this->entityClass();

        $repository = new $repositoryClass($entityClass);
        $request->setResource($repository->find($id));
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    private function post(Request $request)
    {
        $entityClass = $this->entityClass();
        $resource = new $entityClass();
        $request->hyrdateResource($resource);
    }
}
