<?php
/**
 * @author Jonathon Wallen
 * @date 16/12/2016
 * @time 10:35 AM
 * @copyright (c) 2008-Present Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelUrlAlias\Validators;

use Illuminate\Http\Request;
use Illuminate\Routing\Matching\ValidatorInterface;
use Illuminate\Routing\Route;

class UrlAliasValidator implements ValidatorInterface
{
    public function matches(Route $route, Request $request)
    {
        if (is_a($route, 'MonkiiBuilt\LaravelUrlAlias\Routes\UrlAliasRoute')) {
            if (null !== ($urlAlias = $route->getUrlAlias())) {
                /**
                 * If this is a custom url alias route and it has a valid alias object
                 * return true here to allow the route to process the request.
                 */
                return true;
            }
            /**
             * Otherwise return false to display 404 to the user
             */
            return false;
        }
        /**
         * If it's not a custom url alias route return true to pass the validation
         * on to whatever route is supposed to be handling the request.
         */
        return true;
    }
}
