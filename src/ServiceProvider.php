<?php
/**
 * @author Jonathon Wallen
 * @date 10/4/17
 * @time 10:56 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelUrlAlias;

use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use MonkiiBuilt\LaravelUrlAlias\Validators\UrlAliasValidator;
use MonkiiBuilt\LaravelUrlAlias\Routes\UrlAliasRoute;
use Illuminate\Support\Facades\Route as RouteFacade;

class ServiceProvider extends BaseServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(\MonkiiBuilt\LaravelAdministrator\PackageRegistry $packageRegistry, \App\Http\Kernel $kernel, \Illuminate\Routing\Router $router)
    {
        $packageRegistry->registerPackage('LaravelUrlAlias');

        $packageRegistry->registerTab('URL alias', '/admin/pages/{id}/url-alias', 'editPage');

        $this->loadMigrationsFrom(__DIR__.'/../resources/database/migrations');

        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'url-alias');

        /**
         * If the request is a cli / artisan request then we don't want to add the url alias route
         */
        if (!\App::runningInConsole()) {

            /**
             * Add the custom route validator
             */
            $validator = $this->app->make(UrlAliasValidator::class);

            Route::$validators = array_merge(Route::getValidators(), [
                $validator
            ]);

            /**
             * Add the custom url alias route
             */
            $urlAlias = app(UrlAlias::class);

            RouteFacade::getRoutes()->add(new UrlAliasRoute($urlAlias));

        }

        $this->publishes([
            __DIR__.'/../config/laravel-url-alias.php' => config_path('/laravel-administrator/laravel-url-alias.php')
        ], 'administrator-config');
    }
}
