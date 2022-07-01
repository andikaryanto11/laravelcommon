<?php

namespace LaravelCommon\App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use LaravelCommon\System\Database\Schema\Blueprint as SchemaBlueprint;
use LaravelCommon\System\Http\Request\Request as RequestRequest;

class CommonAppServiceProvider extends ServiceProvider
{
    public $bindings = [
        RequestRequest::class => Request::class,
        SchemaBlueprint::class => Blueprint::class
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
        $this->loadMigrationsFrom(__DIR__ . '/../../Database/migrations');
        $this->publishes([
            __DIR__.'/../../Config/entity.php' => config_path('entity.php'),
        ], 'entity-config');
    }
}
