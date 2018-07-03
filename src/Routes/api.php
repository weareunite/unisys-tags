<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'namespace' => '\Unite\Tags\Http\Controllers',
    'middleware' => ['api', 'auth:api', 'authorize'],
    'as' => 'api.'
], function ()
{
    Route::group(['as' => 'tag.', 'prefix' => 'tag'], function ()
    {
        Route::get('/',                             ['as' => 'list',                    'uses' => 'TagController@list']);
        Route::get('{id}',                          ['as' => 'show',                    'uses' => 'TagController@show']);
        Route::put('{id}',                          ['as' => 'update',                  'uses' => 'TagController@update']);
        Route::delete('{id}',                       ['as' => 'delete',                  'uses' => 'TagController@delete']);
    });
});