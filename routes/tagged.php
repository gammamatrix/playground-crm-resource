<?php

/**
 * Playground
 */

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Playground\Crm\Models\Tagged;

/*
|--------------------------------------------------------------------------
| CRM Resource Routes: Tagged
|--------------------------------------------------------------------------
|
|
*/

Route::group([
    'prefix' => 'resource/crm/tagged',
    'middleware' => config('playground-crm-resource.middleware.default'),
    'namespace' => '\Playground\Crm\Resource\Http\Controllers',
], function () {

    // API

    Route::delete('/{tagged}', [
        'as' => 'playground.crm.resource.tagged.destroy',
        'uses' => 'TaggedController@destroy',
    ])->whereUuid('tagged')->can('delete', 'tagged');

    Route::post('/', [
        'as' => 'playground.crm.resource.tagged.post',
        'uses' => 'TaggedController@store',
    ])->can('store', Tagged::class);
});
