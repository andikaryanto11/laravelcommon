<?php

namespace LaravelCommon\App\Http\Middleware;

use Closure;
use Exception;
use LaravelCommon\App\Consts\ResponseConst;
use LaravelCommon\Exceptions\ResponsableException;
use LaravelCommon\Responses\BadRequestResponse;
use LaravelCommon\System\Http\Request;
use LaravelOrm\Entities\EntityUnit as EntitiesEntityUnit;
use Nette\Schema\Expect;

class EntityUnit
{
    public const NAME = 'entity-unit';

    /**
     * Undocumented variable
     *
     * @var EntitiesEntityUnit
     */
    protected EntitiesEntityUnit $entityUnit;

    /**
     * Undocumented function
     *
     * @param EntitiesEntityUnit $entityUnit
     */
    public function __construct(
        EntitiesEntityUnit $entityUnit
    ) {
        $this->entityUnit = $entityUnit;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$method)
    {
        $response = $next($request);
        $resource = $request->getResource();

        try {
            if (strtoupper($request->method()) == 'DELETE') {
                $this->entityUnit->prepareRemove($resource);
            } else {
                $this->entityUnit->preparePersistence($resource);
            }

            $this->entityUnit->flush();
        } catch (Exception $e) {
            throw new ResponsableException($e->getMessage(), new BadRequestResponse($e->getMessage(), ResponseConst::DATA_EXIST));
        }

        return $response;
    }
}
