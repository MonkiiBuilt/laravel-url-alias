<?php
/**
 * @author Jonathon Wallen
 * @date 16/12/2016
 * @time 11:10 AM
 * @copyright (c) 2008-Present Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelUrlAlias\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MonkiiBuilt\LaravelUrlAlias\UrlAlias;
use Illuminate\Routing\Router;
use Illuminate\Contracts\Foundation\Application;

class UrlAliasController extends Controller
{
    /**
     * The application implementation.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * The router instance.
     *
     * @var \Illuminate\Routing\Router
     */
    protected $router;

    /**
     * UrlAliasController constructor.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     * @param \Illuminate\Routing\Router $router
     */
    public function __construct(Application $app, Router $router)
    {
        $this->app = $app;
        $this->router = $router;
    }

    public function index(Request $request, $urlalias_id)
    {
        $urlAlias = UrlAlias::findOrFail($urlalias_id);

        $class = $urlAlias->aliasable_type;

        $model = null;

        if (class_exists($class)) {
            $model = $class::find($urlAlias->aliasable_id);
        }

        if (!$model) {
            abort(404);
        }

        if (isset($model->template) && \View::exists($model->template)) {
            return view($model->template, ['model' => $model]);
        }

        return view('url-alias::url-alias.index', ['model' => $model]);
    }

    /**
     * @param null $aliased_path
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function getPage($aliased_path = null, Request $request)
    {
        $alias = UrlAlias::loadByAliasedPath($aliased_path);

        if(empty($alias)) {
            abort(404);
        }

        if($alias->type == 'alias') {
            $uri = $alias->system_path;
            $method = $request->method();
            $parameters = $request->all();
            $cookies = $request->cookies->all();
            $files = $request->files->all();
            $server = $request->server->all();
            $content = $request->getContent();

            $newRequest = Request::create($uri, $method, $parameters, $cookies, $files, $server, $content);

            $this->app->instance('request', $newRequest);
            return $this->router->dispatch($newRequest);

        } else {
            return redirect(url($alias->system_path), 301);
        }
    }
}
