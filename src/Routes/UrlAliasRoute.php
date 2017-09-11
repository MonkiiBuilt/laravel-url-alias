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

/**
 * Class UrlAliasRoute
 * @package MonkiiBuilt\LaravelUrlAlias\Routes
 */
class UrlAliasRoute extends BaseRoute
{
    /**
     * @var
     */
    protected $validatorOverrides;

    /**
     * @var
     */
    protected $urlAlias;

    /**
     * UrlAliasRoute constructor.
     * @param array|string $urlAlias
     */
    public function __construct($urlAlias)
    {
        $path = app('request')->path();

        $originalRequest = app('request');

        $urlAlias = $urlAlias::where('aliased_path', $path)->first();

        $this->urlAlias = $urlAlias;

        $action = [
            'uses'=> function(Request $request) use ($urlAlias, $originalRequest) {

                /**
                 * If the urlAlias type is not an alias then it's either a 301
                 * or 302 redirect. Just redirect the request to the system_path.
                 */
                if ($urlAlias->type != 'alias') {
                    $status = $urlAlias->type == 'permanent' ? 301 : 302;
                    return redirect(url($urlAlias->system_path), $status);
                }

                /**
                 * Otherwise dispatch the request using the system_path
                 * without any redirect and return the response.
                 */
                $systemPath = $urlAlias->system_path;

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

        parent::__construct(['GET', 'HEAD'], '_url-alias_', $action);
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

    /**
     * @return mixed
     */
    public function getUrlAlias()
    {
        return $this->urlAlias;
    }

}
