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
            if (null === ($urlAlias = $route->getUrlAlias())) {
                return false;
            }
            return true;
        }
        return true;
    }
}
