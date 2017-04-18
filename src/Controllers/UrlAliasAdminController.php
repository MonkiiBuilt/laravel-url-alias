<?php
/**
 * @author Jonathon Wallen
 * @date 18/4/17
 * @time 11:44 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelUrlAlias\Controllers;

use App\Http\Controllers\Controller;
use MonkiiBuilt\LaravelUrlAlias\UrlAlias;

class UrlAliasAdminController extends Controller{

    public function index()
    {
        $redirects = UrlAlias::whereNotNull('system_path')->get();

        return view('url-alias::redirects.index', ['redirects' => $redirects]);
    }

    public function edit()
    {

    }

    public function store()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}