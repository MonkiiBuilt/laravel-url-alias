<?php

namespace MonkiiBuilt\LaravelUrlAlias\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class CheckUrlAlias
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // We add our catch all route here to make sure it's the last one added
        Route::get('{alias}', [
            'uses' => 'MonkiiBuilt\LaravelUrlAlias\Controllers\UrlAliasController@getPage'
        ])->where('alias', '([A-Za-z0-9\-\/]+)');

        return $next($request);
    }
}
