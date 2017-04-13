<?php
/**
 * @author Jonathon Wallen
 * @date 10/4/17
 * @time 11:57 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */
// pages

Route::get('/url-alias/{page}', ['uses' => 'MonkiiBuilt\LaravelUrlAlias\Controllers\UrlAliasController@index', 'as' => 'url-alias.show']);

Route::get('/admin/redirects', ['as' => 'administrator-url-alias', function(Request $request) {
    return response('hiya');
}]);