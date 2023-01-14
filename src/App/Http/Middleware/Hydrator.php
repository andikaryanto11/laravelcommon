<?php

namespace LaravelCommon\App\Http\Middleware;

use Closure;
use Exception;
use LaravelCommon\Exceptions\ResponsableException;
use LaravelCommon\Responses\NoDataFoundResponse;
use LaravelCommon\System\Http\Request;
use LaravelOrm\Exception\EntityException;

class Hydrator
{

    protected $resource;

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
     * Key of hydrator, will be a routing parameter.
     *
     * @return string
     */
    public function getKey(): string
    {
        throw new Exception('"getKey" needs to be overriden on your hydrator classes');
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
        $request->setHydrator($this);

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
        $this->resource = $this->getEntity($request);
        $request->setResource($this->resource);
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
        $this->resource = $repository->newEntity();
        $request->hyrdateResource($this->resource);
        $this->hydrateObjects($request->input());
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    private function delete(Request $request)
    {
        $this->resource = $this->getEntity($request);
        $request->setResource($this->resource);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    private function patch(Request $request)
    {
        $this->resource = $this->getEntity($request);
        $request->setResource($this->resource);
        
        $request->hyrdateResource($this->resource);
    }

    /**
     * hydrate resource
     *
     * @param array $input
     * @return void
     */
    protected function hydrateObjects(array $input) 
    {

    }

    /**
     * Get entity instance
     *
     * @param Request $request
     * @return mixed
     */
    private function getEntity(Request $request)
    {

        $id = $request->route()->parameter($this->getKey());
        $repositoryClass = $this->repositoryClass();

        $repository = new $repositoryClass();
        try {
            $resource = $repository->findOrFail($id);
        } catch (EntityException $e) {
            throw new ResponsableException($e->getMessage(), new NoDataFoundResponse('No Data Found'));
        }

        return $resource;
    }
}
