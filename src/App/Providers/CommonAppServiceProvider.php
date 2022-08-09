<?php

namespace LaravelCommon\App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use LaravelCommon\App\Http\Middleware\CheckScope;
use LaravelCommon\App\Http\Middleware\ControllerAfter;
use LaravelCommon\App\Http\Middleware\TokenValid;
use LaravelCommon\System\Database\Schema\Blueprint as SchemaBlueprint;
use LaravelCommon\System\Http\Request\Request as RequestRequest;

class CommonAppServiceProvider extends ServiceProvider
{
    public $bindings = [
        // RequestRequest::class => Request::class,
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
        $this->loadMigrationsFrom(__DIR__ . '/../../Database/migrations');

        $this->loadRoutesFrom(__DIR__ . '/../../Routes/api.php');

        $this->publishConfig();

        $this->registerMiddleware();
       
    }

    /**
     * Publish all config
     *
     * @return void
     */
    private function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../../Config/entity.php' => config_path('entity.php'),
        ], 'entity-config');

        $this->publishes([
            __DIR__ . '/../../Config/jwt.php' => config_path('jwt.php'),
        ], 'laravel-common-jwt-config');

        $this->publishes([
            __DIR__ . '/../../Config/kernel.php' => config_path('kernel.php'),
        ], 'laravel-common-kernel');
    }

    /**
     * register middlewares
     *
     * @return void
     */
    private function registerMiddleware(){
        $router = $this->app['router'];

        $router->aliasMiddleware('controller-after', ControllerAfter::class);
        $router->pushMiddlewareToGroup('api', ControllerAfter::class);

        $router->aliasMiddleware('token-valid', TokenValid::class);
        $router->aliasMiddleware('check-scope', CheckScope::class);
    }
}
