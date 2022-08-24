<?php

namespace LaravelCommon\App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use LaravelCommon\App\Console\Commands\GenerateEntity;
use LaravelCommon\App\Http\Middleware\CheckScope;
use LaravelCommon\App\Http\Middleware\CheckToken;
use LaravelCommon\App\Http\Middleware\ControllerAfter;
use LaravelCommon\App\Http\Middleware\EntityUnit;
use LaravelCommon\App\Http\Middleware\ResourceValidation;
use LaravelCommon\App\Http\Middleware\RouteChecker;
use LaravelCommon\System\Database\Schema\Blueprint as SchemaBlueprint;

class CommonAppServiceProvider extends ServiceProvider
{
    public $bindings = [
        // Request::class => RequestRequest::class,
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

        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateEntity::class,
            ]);
        }
       
    }

    /**
     * Publish all config
     *
     * @return void
     */
    private function publishConfig()
    {
        $this->publishes([

            __DIR__ . '/../../Config/common-config.php' => config_path('common-config.php'),
        ], 'laravel-common-config');
        
    }

    /**
     * register middlewares
     *
     * @return void
     */
    private function registerMiddleware(){
        $router = $this->app['router'];

        $router->aliasMiddleware('controller-after', ControllerAfter::class);
        // $router->aliasMiddleware('route-checker', RouteChecker::class);
        $router->pushMiddlewareToGroup('api', ControllerAfter::class);
        // $router->pushMiddlewareToGroup('api', RouteChecker::class);

        $router->aliasMiddleware('check-token', CheckToken::class);
        $router->aliasMiddleware('check-scope', CheckScope::class);
        $router->aliasMiddleware('entity-unit', EntityUnit::class);
        $router->aliasMiddleware('resource-validation', ResourceValidation::class);
    }
}
