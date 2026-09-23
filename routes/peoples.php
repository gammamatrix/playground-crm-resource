<?php

/**
 * Playground
 */

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Playground\Crm\Models\People;

/*
|--------------------------------------------------------------------------
| CRM Resource Routes: People
|--------------------------------------------------------------------------
|
|
*/

Route::group([
    'prefix' => 'resource/crm/people',
    'middleware' => config('playground-crm-resource.middleware.default'),
    'namespace' => '\Playground\Crm\Resource\Http\Controllers',
], function () {

    Route::get('/{people:slug}', [
        'as' => 'playground.crm.resource.peoples.slug',
        'uses' => 'PeopleController@show',
    ])->where('slug', '[a-zA-Z0-9\-]+');
});

Route::group([
    'prefix' => 'resource/crm/peoples',
    'middleware' => config('playground-crm-resource.middleware.default'),
    'namespace' => '\Playground\Crm\Resource\Http\Controllers',
], function () {
    Route::get('/', [
        'as' => 'playground.crm.resource.peoples',
        'uses' => 'PeopleController@index',
    ])->can('index', People::class);

    Route::post('/index', [
        'as' => 'playground.crm.resource.peoples.index',
        'uses' => 'PeopleController@index',
    ])->can('index', People::class);

    // UI

    Route::get('/create', [
        'as' => 'playground.crm.resource.peoples.create',
        'uses' => 'PeopleController@create',
    ])->can('create', People::class);

    Route::get('/edit/{people}', [
        'as' => 'playground.crm.resource.peoples.edit',
        'uses' => 'PeopleController@edit',
    ])->whereUuid('people')->can('edit', 'people');

    // Route::get('/go/{id}', [
    //     'as' => 'playground.crm.resource.peoples.go',
    //     'uses' => 'PeopleController@go',
    // ]);

    Route::get('/{people}', [
        'as' => 'playground.crm.resource.peoples.show',
        'uses' => 'PeopleController@show',
    ])->whereUuid('people')->can('detail', 'people')->withTrashed();

    // API

    Route::put('/lock/{people}', [
        'as' => 'playground.crm.resource.peoples.lock',
        'uses' => 'PeopleController@lock',
    ])->whereUuid('people')->can('lock', 'people');

    Route::delete('/lock/{people}', [
        'as' => 'playground.crm.resource.peoples.unlock',
        'uses' => 'PeopleController@unlock',
    ])->whereUuid('people')->can('unlock', 'people');

    Route::delete('/{people}', [
        'as' => 'playground.crm.resource.peoples.destroy',
        'uses' => 'PeopleController@destroy',
    ])->whereUuid('people')->can('delete', 'people')->withTrashed();

    Route::put('/restore/{people}', [
        'as' => 'playground.crm.resource.peoples.restore',
        'uses' => 'PeopleController@restore',
    ])->whereUuid('people')->can('restore', 'people')->withTrashed();

    Route::post('/', [
        'as' => 'playground.crm.resource.peoples.post',
        'uses' => 'PeopleController@store',
    ])->can('store', People::class);

    // Route::put('/', [
    //     'as' => 'playground.crm.resource.peoples.put',
    //     'uses' => 'PeopleController@store',
    // ])->can('store', Playground\Crm\Models\People::class);
    //
    // Route::put('/{people}', [
    //     'as' => 'playground.crm.resource.peoples.put.id',
    //     'uses' => 'PeopleController@store',
    // ])->whereUuid('people')->can('update', 'people');

    Route::patch('/{people}', [
        'as' => 'playground.crm.resource.peoples.patch',
        'uses' => 'PeopleController@update',
    ])->whereUuid('people')->can('update', 'people');
});
