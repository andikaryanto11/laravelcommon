<?php

namespace LaravelCommon\App\Http\Middleware;

use Closure;
use Exception;
use LaravelCommon\App\Consts\ResponseConst;
use LaravelCommon\Exceptions\ResponsableException;
use LaravelCommon\Responses\BadRequestResponse;
use LaravelCommon\System\Http\Request;
use LaravelCommon\Utilities\Database\ModelUnit as DatabaseModelUnit;

class ModelUnit
{
    public const NAME = 'common.app.middlware.model-unit';

    /**
     *
     * @var DatabaseModelUnit
     */
    protected DatabaseModelUnit $modelUnit;

    /**
     *
     * @param DatabaseModelUnit $modelUnit
     */
    public function __construct(
        DatabaseModelUnit $modelUnit
    ) {
        $this->modelUnit = $modelUnit;
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
        $response = $next($request);

        try {
            $this->$method($request);
        } catch (Exception $e) {
            throw new ResponsableException($e->getMessage(), new BadRequestResponse($e->getMessage(), ResponseConst::DATA_EXIST));
        }

        return $response;
    }

    private function persist($request)
    {
        try {
            $resource = $request->getResource();
            $this->modelUnit->persist($resource);
            $this->modelUnit->flush();
        } catch (Exception $e) {
            throw new ResponsableException($e->getMessage(), new BadRequestResponse($e->getMessage(), ResponseConst::DATA_EXIST));
        }
    }

    private function remove($request)
    {
        try {
            $resource = $request->getResource();
            $this->modelUnit->remove($resource);
            $this->modelUnit->flush();
        } catch (Exception $e) {
            throw new ResponsableException($e->getMessage(), new BadRequestResponse($e->getMessage(), ResponseConst::DATA_EXIST));
        }
    }

    private function commit($request)
    {
        try {
            $this->modelUnit->flush();
        } catch (Exception $e) {
            throw new ResponsableException($e->getMessage(), new BadRequestResponse($e->getMessage(), ResponseConst::DATA_EXIST));
        }
    }
}
