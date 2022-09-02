<?php

namespace LaravelCommon\App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use LaravelCommon\System\Http\Request;

class Kernel extends HttpKernel
{
    /**
     * Handle an incoming HTTP request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handle($request)
    {
        return parent::handle(
            Request::createFrom($request)
        );
    }

    /**
     * flexible create request from any custom request class
     *
     * @param string $requestClass
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @return void
     */
    public function handleRequest(string $requestClass, $request)
    {
        return parent::handle(
            $requestClass::createFrom($request)
        );
    }
}
