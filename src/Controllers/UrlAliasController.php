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

class UrlAliasController extends Controller
{
    public function index(Request $request, $content)
    {
        if (isset($content->template) && \View::exists($content->template)) {
            return view($content->template, ['content' => $content]);
        }
        return view('url-alias::index', ['content' => $content]);
    }
}
