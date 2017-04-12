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

class UrlAliasController extends Controller
{
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
}
