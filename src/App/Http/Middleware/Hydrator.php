<?php

namespace LaravelCommon\App\Http\Middleware;

use Closure;
use Exception;
use LaravelCommon\Exceptions\ResponsableExeption;
use LaravelCommon\Responses\NoDataFoundResponse;
use LaravelCommon\System\Http\Request;
use LaravelOrm\Exception\EntityException;

class Hydrator
{

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
        if (strtoupper($request->method()) == 'POST') {
            $this->post($request);
        }

        if (strtoupper($request->method())  == 'GET') {
            $this->get($request);
        }

        if (strtoupper($request->method()) == 'PATCH') {
            $this->patch($request);
        }

        if (strtoupper($request->method()) == 'DELETE') {
            $this->delete($request);
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
        $resource = $this->getEntity($request);
        $request->setResource($resource);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    private function post(Request $request)
    {
        $repositoryClass = $this->repositoryClass();
        $repository = new $repositoryClass();
        $resource = $repository->newEntity();
        $request->hyrdateResource($resource);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    private function delete(Request $request){
        $resource = $this->getEntity($request);
        $request->setResource($resource);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    private function patch(Request $request)
    {
        $resource = $this->getEntity($request);
        $request->setResource($resource);
        $request->hyrdateResource($resource);
    }

    /**
     * Get entity instance
     *
     * @param Request $request
     * @return mixed
     */
    private function getEntity(Request $request){

        $id = $request->route()->parameter('id');
        $repositoryClass = $this->repositoryClass();

        $repository = new $repositoryClass();
        try{
            $resource = $repository->findOrFail($id);
        } catch(EntityException $e){
            throw new ResponsableExeption($e->getMessage(), new NoDataFoundResponse('No Data Found'));
        }

        return $resource;
    }
}
