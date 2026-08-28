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

Route::prefix('status')->group(function() {
    Route::get('/', 'StatusController@index');
});


Route::group([
    'middleware' =>[ 'web','impersonate'],
    'namespace' => 'Modules\Status\Http\Controllers'
], function () {
    Route::prefix('status')->group(function() {
   
            Route::post('/update/{order}', 'Main@update')->name('status.update');
        

    });
});