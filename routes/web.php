<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
    'register' => false,
    'verify' => true,
    'reset' => false
]);

Route::group(['middleware' => ['auth']], function () {

    # Start Page
    Route::get('/', function ()
    {
        return redirect('/contacts');
    });


    # Contacts
    Route::resource('/contacts', 'ContactController')->except([
        'create', 'store', 'update', 'destroy'
    ]);
    Route::get('/contacts/{id}/delete', 'ContactController@delete');

});
