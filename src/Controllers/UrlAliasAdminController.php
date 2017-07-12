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
use MonkiiBuilt\LaravelAdministrator\PackageRegistry;

/**
 * Class UrlAliasAdminController
 * @package MonkiiBuilt\LaravelUrlAlias\Controllers
 */
class UrlAliasAdminController extends Controller
{
    private $packageRegistry;

    public function __construct(PackageRegistry $packageRegistry)
    {
        $this->packageRegistry = $packageRegistry;
    }

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

    /**
     * Return form to add / edit the alias for this page.
     *
     * @param $page_id
     *
     * @return mixed
     */
    public function createAlias($page_id) {

        $systemPath = '/page/' . $page_id;

        // Try and load an existing alias
        $alias = UrlAlias::loadBySystemPath($systemPath);
        $tabs = $this->packageRegistry->getTabs('editPage', $page_id);

        return view('url-alias::aliases.edit', [
            'page_id' => $page_id,
            'alias_id' => empty($alias->id) ? null : $alias->id,
            'aliased_path' => empty($alias->aliased_path) ? '' : trim($alias->aliased_path, '/'),
            'tabs' => $tabs,
        ]);
    }

    /**
     * @param $page_id
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function storeAlias($page_id, Request $request)
    {
        if(!empty($request->alias_id)) {
            $alias = UrlAlias::findOrFail($request->alias_id);
        } else {
            $alias = new UrlAlias;
        }
        $alias->system_path = '/pages/' . $page_id;
        $alias->aliased_path = '/' . $request->aliased_path;
        $alias->type = 'alias';
        $alias->save();
        return \Redirect::route('laravel-administrator-pages')->with(['success' => 'Alias created']);
    }
}
