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
    public function boot(\MonkiiBuilt\LaravelAdministrator\PackageRegistry $packageRegistry)
    {
        $packageRegistry->registerPackage('LaravelUrlAlias');

        $packageRegistry->registerTab('URL alias', '/admin/pages/{id}/url-alias', 'editPage');

        $this->loadMigrationsFrom(__DIR__.'/../resources/database/migrations');

        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'url-alias');

        // I'm not sure what this is for but don't think it's needed for the
        // new URL aliasing system (but leaving just in case)
        // Please fully delete if no longer required.
//        if (!\App::runningInConsole()) {
//
//            $validator = $this->app->make(UrlAliasValidator::class);
//
//            Route::$validators = array_merge(Route::getValidators(), [
//                $validator
//            ]);
//
//            $urlAlias = app(UrlAlias::class);
//
//            RouteFacade::getRoutes()->add(new UrlAliasRoute($urlAlias));
//
//        }

        $this->publishes([
            __DIR__.'/../config/laravel-url-alias.php' => config_path('/laravel-administrator/laravel-url-alias.php')
        ], 'administrator-config');
    }
}
