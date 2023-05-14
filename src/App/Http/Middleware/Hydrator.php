<?php

namespace LaravelCommon\App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use LaravelCommon\App\Repositories\Repository;
use LaravelCommon\Exceptions\ResponsableException;
use LaravelCommon\Responses\NotFoundResponse;
use Illuminate\Http\Request;

class Hydrator
{
    protected array $hydrateKeys = [];

    protected Model $entity;

    protected $key;

    protected string $method;

    protected Repository $repository;

    protected Request $request;

    /**
     * Hydrator constructor
     *
     * @param string $key
     * @param Repository $repository
     */
    public function __construct(
        string $key,
        Repository $repository
    ) {
        $this->key = $key;
        $this->repository = $repository;
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

        $this->request = $request;
        $this->method = $method;
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
        $this->entity = $this->getModel($request);
        $request->setResource($this->entity);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    private function post(Request $request)
    {
        $this->entity = $this->repository->newModel();
        $request->setResource($this->entity);
        $this->hydrate();
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
        $this->entity = $this->getModel($request);
        $request->setResource($this->entity);
        $this->hydrate();
    }

    /**
     * Do something after hydrate
     * @return $this
     */
    public function afterHydrate()
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
        $this->entity = $this->getModel($request);
        $request->setResource($this->entity);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    private function patch(Request $request)
    {
        $this->entity = $this->getModel($request);
        $request->setResource($this->entity);

        $this->hydrate();
    }

    /**
     * hydrate
     *
     * @return void
     */
    public function hydrate()
    {
    }

    /**
     * Get entity instance
     *
     * @param Request $request
     * @return mixed
     */
    private function getModel(Request $request)
    {
        $id = $request->route()->parameter($this->key);
        try {
            $resource = $this->repository->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ResponsableException($e->getMessage(), new NotFoundResponse('No Data Found'));
        }

        return $resource;
    }

    /**
     * Undocumented function
     *
     * @param string $key
     * @param array $entitySetter
     * @param array $relatedObjectGetter
     * @return Hydrator
     */
    public function when(string $key, array $entitySetter, array $relatedObjectGetter = []): Hydrator
    {
        $input = $this->request->input();

        $keyArr = explode('.', $key);
        $entity = $entitySetter[0];
        $entitySetterFunction = $entitySetter[1];
        $field = $keyArr[0];

        if (isset($input[$field]) && !empty($relatedObjectGetter)) {
            $id = $keyArr[1];
            $relatedValue = $input[$field][$id];

            $relatedRepository = $relatedObjectGetter[0];
            $relatedFunction = $relatedObjectGetter[1];
            $relatedObject = $relatedRepository->$relatedFunction($relatedValue);

            $entity->$entitySetterFunction($relatedObject);
        }

        if (isset($input[$field]) && empty($relatedObjectGetter)) {
            $entity->$entitySetterFunction($input[$field]);
        }

        return $this;
    }
}
