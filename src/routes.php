<?php
/**
 * @author Jonathon Wallen
 * @date 10/4/17
 * @time 11:57 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */
// pages

//Route::get('/pages/{page}', ['uses' => 'MonkiiBuilt\LaravelUrlAlias\Controllers\UrlAliasController@index', 'as' => 'url-alias.show']);


Route::group(['prefix' => 'admin', 'namespace' => 'MonkiiBuilt\LaravelUrlAlias', 'middleware' => ['laravel-administrator-menus', 'web']], function () {

    Route::get('/redirects', ['as' => 'laravel-administrator-url-alias', 'uses' => 'Controllers\UrlAliasAdminController@index']);

    Route::get('/redirects/create', ['as' => 'laravel-administrator-url-alias-create', 'uses' => 'Controllers\UrlAliasAdminController@create']);

    Route::get('/redirects/{id}/edit', ['as' => 'laravel-administrator-url-alias-edit', 'uses' => 'Controllers\UrlAliasAdminController@edit']);

    Route::post('/redirects', ['as' => 'laravel-administrator-url-alias-post', 'uses' => 'Controllers\UrlAliasAdminController@store']);

    Route::put('/redirects/{id}', ['as' => 'laravel-administrator-url-alias-put', 'uses' => 'Controllers\UrlAliasAdminController@update']);

    Route::delete('/redirects/{id}', ['as' => 'laravel-administrator-url-alias-delete', 'uses' => 'Controllers\UrlAliasAdminController@destroy']);

    Route::get('/pages/{id}/url-alias', ['as' => 'laravel-administrator-url-alias-create-alias', 'uses' => 'Controllers\UrlAliasAdminController@createAlias']);

    Route::post('/pages/{id}/url-alias', ['as' => 'laravel-administrator-url-alias-store', 'uses' => 'Controllers\UrlAliasAdminController@storeAlias']);
});
