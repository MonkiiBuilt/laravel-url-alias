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
use Illuminate\Http\Request;

/**
 * Class UrlAliasAdminController
 * @package MonkiiBuilt\LaravelUrlAlias\Controllers
 */
class UrlAliasAdminController extends Controller{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $redirects = UrlAlias::whereNotNull('system_path')->get();

        return view('url-alias::redirects.index', ['redirects' => $redirects]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('url-alias::redirects.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $urlAlias = UrlAlias::findOrFail($id);

        return view('url-alias::redirects.edit', ['redirect' => $urlAlias]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['system_path'] = trim($data['system_path']);
        $data['system_path'] = trim($data['system_path'], '/');
        UrlAlias::create($data);
        return \Redirect::route('laravel-administrator-url-alias')->with(['success' => 'Redirect created']);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $urlAlias = UrlAlias::findOrFail($id);

        $urlAlias->path = $request->input('path');
        $urlAlias->system_path = trim($request->input('system_path'), '/');
        $urlAlias->save();
        return \Redirect::route('laravel-administrator-url-alias')->with(['success' => 'Redirect updated']);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return mixed
     */
    public function destroy(Request $request, $id)
    {
        $urlAlias = UrlAlias::findOrFail($id);
        $urlAlias->delete();
        return \Redirect::route('laravel-administrator-url-alias')->with(['success' => 'Redirect deleted']);
    }
}