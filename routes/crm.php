<?php

/**
 * Playground
 */

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Playground\Crm\Models\Client;

/*
|--------------------------------------------------------------------------
| CRM Routes
|--------------------------------------------------------------------------
|
|
*/

Route::group([
    'prefix' => 'resource/crm',
    'middleware' => config('playground-crm-resource.middleware.default'),
    'namespace' => '\Playground\Crm\Resource\Http\Controllers',
], function () {

    Route::get('/', [
        'as' => 'playground.crm.resource',
        'uses' => 'IndexController@index',
    ])->can('index', Client::class);

});
