<?php
/**
 * @author Jonathon Wallen
 * @date 16/12/2016
 * @time 10:50 AM
 * @copyright (c) 2008-Present Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelUrlAlias\Routes;

use Illuminate\Routing\Route as BaseRoute;
use MonkiiBuilt\LaravelUrlAlias\Validators\UrlAliasValidator;
use Illuminate\Routing\Matching\MethodValidator;
use Illuminate\Routing\Matching\SchemeValidator;
use Illuminate\Routing\Matching\HostValidator;
use Illuminate\Http\Request;

class UrlAliasRoute extends BaseRoute
{
    protected $validatorOverrides;

    protected $urlAlias;

    public function __construct($urlAlias)
    {
        $path = app('request')->path();

        $originalRequest = app('request');

        $urlAlias = $urlAlias::where('path', $path)->first();

        $this->urlAlias = $urlAlias;

        $action = [
            'uses'=> function(Request $request) use ($urlAlias, $originalRequest) {

                if ($urlAlias->system_path) {
                    return redirect(url($urlAlias->system_path), 301);
                }

                $systemPath = 'pages/' . $urlAlias->aliasable->id;

                $request->server->set('REQUEST_URI', $systemPath);

                $request->initialize(
                    $originalRequest->query->all(),
                    $originalRequest->request->all(),
                    $originalRequest->attributes->all(),
                    $originalRequest->cookies->all(),
                    $originalRequest->files->all(),
                    $request->server->all(),
                    $originalRequest->getContent()
                );

                return \Route::dispatchToRoute($request);
            },
        ];
        $action['uses']->bindTo($this);
        parent::__construct(['GET', 'HEAD'], '{path}', $action);
    }

    /**
     * Determine if the route matches given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $includingMethod
     * @return bool
     */
    public function matches(Request $request, $includingMethod = true)
    {
        $this->compileRoute();

        $validators = $this->getValidatorOverrides();

        foreach ($validators as $validator) {
            /*if (! $includingMethod && $validator instanceof MethodValidator) {
                continue;
            }*/

            if (! $validator->matches($this, $request)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the route validators for the instance.
     *
     * @return array
     */
    public function getValidatorOverrides()
    {
        if (isset($this->validatorOverrides)) {
            return $this->validatorOverrides;
        }

        $this->validatorOverrides = [
            new MethodValidator, new SchemeValidator,
            new HostValidator, /*new UriValidator,*/
            new UrlAliasValidator($this->urlAlias),
        ];

        return $this->validatorOverrides;
    }

    public function getUrlAlias()
    {
        return $this->urlAlias;
    }

}
