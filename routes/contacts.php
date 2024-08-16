<?php
/**
 * Playground
 */

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CRM Resource Routes: Contact
|--------------------------------------------------------------------------
|
|
*/

Route::group([
    'prefix' => 'api/crm/contact',
    'middleware' => config('playground-crm-resource.middleware.default'),
    'namespace' => '\Playground\Crm\Resource\Http\Controllers',
], function () {

    Route::get('/{contact:slug}', [
        'as' => 'playground.crm.resource.contacts.slug',
        'uses' => 'ContactController@show',
    ])->where('slug', '[a-zA-Z0-9\-]+');
});

Route::group([
    'prefix' => 'resource/crm/contacts',
    'middleware' => config('playground-crm-resource.middleware.default'),
    'namespace' => '\Playground\Crm\Resource\Http\Controllers',
], function () {
    Route::get('/', [
        'as' => 'playground.crm.resource.contacts',
        'uses' => 'ContactController@index',
    ])->can('index', Playground\Crm\Models\Contact::class);

    Route::post('/index', [
        'as' => 'playground.crm.resource.contacts.index',
        'uses' => 'ContactController@index',
    ])->can('index', Playground\Crm\Models\Contact::class);

    // UI

    Route::get('/create', [
        'as' => 'playground.crm.resource.contacts.create',
        'uses' => 'ContactController@create',
    ])->can('create', Playground\Crm\Models\Contact::class);

    Route::get('/edit/{contact}', [
        'as' => 'playground.crm.resource.contacts.edit',
        'uses' => 'ContactController@edit',
    ])->whereUuid('contact')->can('edit', 'contact');

    // Route::get('/go/{id}', [
    //     'as' => 'playground.crm.resource.contacts.go',
    //     'uses' => 'ContactController@go',
    // ]);

    Route::get('/{contact}', [
        'as' => 'playground.crm.resource.contacts.show',
        'uses' => 'ContactController@show',
    ])->whereUuid('contact')->can('detail', 'contact');

    // API

    Route::put('/lock/{contact}', [
        'as' => 'playground.crm.resource.contacts.lock',
        'uses' => 'ContactController@lock',
    ])->whereUuid('contact')->can('lock', 'contact');

    Route::delete('/lock/{contact}', [
        'as' => 'playground.crm.resource.contacts.unlock',
        'uses' => 'ContactController@unlock',
    ])->whereUuid('contact')->can('unlock', 'contact');

    Route::delete('/{contact}', [
        'as' => 'playground.crm.resource.contacts.destroy',
        'uses' => 'ContactController@destroy',
    ])->whereUuid('contact')->can('delete', 'contact')->withTrashed();

    Route::put('/restore/{contact}', [
        'as' => 'playground.crm.resource.contacts.restore',
        'uses' => 'ContactController@restore',
    ])->whereUuid('contact')->can('restore', 'contact')->withTrashed();

    Route::post('/', [
        'as' => 'playground.crm.resource.contacts.post',
        'uses' => 'ContactController@store',
    ])->can('store', Playground\Crm\Models\Contact::class);

    // Route::put('/', [
    //     'as' => 'playground.crm.resource.contacts.put',
    //     'uses' => 'ContactController@store',
    // ])->can('store', Playground\Crm\Models\Contact::class);
    //
    // Route::put('/{contact}', [
    //     'as' => 'playground.crm.resource.contacts.put.id',
    //     'uses' => 'ContactController@store',
    // ])->whereUuid('contact')->can('update', 'contact');

    Route::patch('/{contact}', [
        'as' => 'playground.crm.resource.contacts.patch',
        'uses' => 'ContactController@update',
    ])->whereUuid('contact')->can('update', 'contact');
});
