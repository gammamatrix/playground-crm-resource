<?php
/**
 * Playground
 */

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CRM Resource Routes: Organization
|--------------------------------------------------------------------------
|
|
*/

Route::group([
    'prefix' => 'api/crm/organization',
    'middleware' => config('playground-crm-resource.middleware.default'),
    'namespace' => '\Playground\Crm\Resource\Http\Controllers',
], function () {

    Route::get('/{organization:slug}', [
        'as' => 'playground.crm.resource.organizations.slug',
        'uses' => 'OrganizationController@show',
    ])->where('slug', '[a-zA-Z0-9\-]+');
});

Route::group([
    'prefix' => 'resource/crm/organizations',
    'middleware' => config('playground-crm-resource.middleware.default'),
    'namespace' => '\Playground\Crm\Resource\Http\Controllers',
], function () {
    Route::get('/', [
        'as' => 'playground.crm.resource.organizations',
        'uses' => 'OrganizationController@index',
    ])->can('index', Playground\Crm\Models\Organization::class);

    Route::post('/index', [
        'as' => 'playground.crm.resource.organizations.index',
        'uses' => 'OrganizationController@index',
    ])->can('index', Playground\Crm\Models\Organization::class);

    // UI

    Route::get('/create', [
        'as' => 'playground.crm.resource.organizations.create',
        'uses' => 'OrganizationController@create',
    ])->can('create', Playground\Crm\Models\Organization::class);

    Route::get('/edit/{organization}', [
        'as' => 'playground.crm.resource.organizations.edit',
        'uses' => 'OrganizationController@edit',
    ])->whereUuid('organization')->can('edit', 'organization');

    // Route::get('/go/{id}', [
    //     'as' => 'playground.crm.resource.organizations.go',
    //     'uses' => 'OrganizationController@go',
    // ]);

    Route::get('/{organization}', [
        'as' => 'playground.crm.resource.organizations.show',
        'uses' => 'OrganizationController@show',
    ])->whereUuid('organization')->can('detail', 'organization');

    // API

    Route::put('/lock/{organization}', [
        'as' => 'playground.crm.resource.organizations.lock',
        'uses' => 'OrganizationController@lock',
    ])->whereUuid('organization')->can('lock', 'organization');

    Route::delete('/lock/{organization}', [
        'as' => 'playground.crm.resource.organizations.unlock',
        'uses' => 'OrganizationController@unlock',
    ])->whereUuid('organization')->can('unlock', 'organization');

    Route::delete('/{organization}', [
        'as' => 'playground.crm.resource.organizations.destroy',
        'uses' => 'OrganizationController@destroy',
    ])->whereUuid('organization')->can('delete', 'organization')->withTrashed();

    Route::put('/restore/{organization}', [
        'as' => 'playground.crm.resource.organizations.restore',
        'uses' => 'OrganizationController@restore',
    ])->whereUuid('organization')->can('restore', 'organization')->withTrashed();

    Route::post('/', [
        'as' => 'playground.crm.resource.organizations.post',
        'uses' => 'OrganizationController@store',
    ])->can('store', Playground\Crm\Models\Organization::class);

    // Route::put('/', [
    //     'as' => 'playground.crm.resource.organizations.put',
    //     'uses' => 'OrganizationController@store',
    // ])->can('store', Playground\Crm\Models\Organization::class);
    //
    // Route::put('/{organization}', [
    //     'as' => 'playground.crm.resource.organizations.put.id',
    //     'uses' => 'OrganizationController@store',
    // ])->whereUuid('organization')->can('update', 'organization');

    Route::patch('/{organization}', [
        'as' => 'playground.crm.resource.organizations.patch',
        'uses' => 'OrganizationController@update',
    ])->whereUuid('organization')->can('update', 'organization');
});
