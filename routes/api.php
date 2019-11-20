<?php

use Illuminate\Http\Request;


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

Route::prefix('v1')->group(function () {

    Route::apiResource('contacts', 'Api\ApiContactController')->only([
        'index', 'store', 'update', 'destroy'
    ]);

    // Route::apiResources([
    //     'contacts' => 'Api\ApiContactController',
    // ]);
});
