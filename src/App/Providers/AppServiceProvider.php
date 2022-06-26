<?php

namespace LaravelCommon\App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use LaravelCommon\Database\Schema\Blueprint as SchemaBlueprint;
use LaravelCommon\Http\Request\Request as RequestRequest;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        Request::class => RequestRequest::class,
        Blueprint::class => SchemaBlueprint::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
