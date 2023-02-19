<?php

namespace LaravelCommon\App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use LaravelCommon\App\Repositories\Repository;
use LaravelCommon\Exceptions\ResponsableException;
use LaravelCommon\Responses\NoContentResponse;
use LaravelCommon\Responses\NotFoundResponse;
use LaravelCommon\System\Http\Request;
use LaravelOrm\Exception\EntityException;

class Hydrator
{
    protected $resource;

    protected Repository $repository;

    public function __construct(
        Repository $repository
    ) {
        $this->repository = $repository;
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
    public function handle(Request $request, Closure $next, $method)
    {
        // $request->setHydrator($this);

        if (strtoupper($method) == 'POST') {
            $this->post($request);
        }

        if (strtoupper($method)  == 'GET') {
            $this->get($request);
        }

        if (strtoupper($method)  == 'PUT') {
            $this->put($request);
        }

        if (strtoupper($method) == 'PATCH') {
            $this->patch($request);
        }

        if (strtoupper($method) == 'DELETE') {
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
        $this->resource = $this->getModel($request);
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
        $this->resource = $repository->newModel();
        $request->setResource($this->resource);
        $this->hydrate($this->resource, $request);
        $this->afterHydrate($request);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    private function put(Request $request)
    {
        $this->resource = $this->getModel($request);
        $request->setResource($this->resource);
        $this->hydrate($this->resource, $request);
    }

    public function afterHydrate(Request $request)
    {
        return $this;
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    private function delete(Request $request)
    {
        $this->resource = $this->getModel($request);
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
        $this->resource = $this->getModel($request);
        $request->setResource($this->resource);

        $this->hydrate($this->resource, $request);
    }

    /**
     * hydrate resource
     *
     * @param array $input
     * @return array
     */
    protected function hydrateObjects()
    {
        return [];
    }

    /**
     * Hydrate model
     *
     * @param Model $model
     * @param Request $request
     * @return void
     */
    private function hydrate(Model $model, Request $request)
    {
        $input = $request->input();
        foreach ($input as $key => $value) {
            $model->$key = $value;
        }

        // $hydrateObjects = $this->hydrateObjects();

        // foreach ($hydrateObjects as $key => $hydrateObject) {
        //     if (array_key_exists($key, $input)) {
        //         if (count($hydrateObject) == 2) {
        //             $repoMethod = $hydrateObject[1][1];
        //             $resource = $hydrateObject[1][0]->$repoMethod($input[$key]);
        //             if ($resource) {
        //                 $entityMethod = $hydrateObject[0][1];
        //                 $hydrateObject[0][0]->$entityMethod($resource);
        //             }
        //         }

        //         if (count($hydrateObject) == 1) {
        //             $entityMethod = $hydrateObject[0][1];
        //             $hydrateObject[0][0]->$entityMethod($resource);
        //         }
        //     }
        // }
    }

    /**
     * Get entity instance
     *
     * @param Request $request
     * @return mixed
     */
    private function getModel(Request $request)
    {

        $id = $request->route()->parameter($this->getKey());
        // $repositoryClass = $this->repositoryClass();

        // $repository = new $repositoryClass();
        try {
            $resource = $this->repository->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ResponsableException($e->getMessage(), new NotFoundResponse('No Data Found'));
        }

        return $resource;
    }
}
