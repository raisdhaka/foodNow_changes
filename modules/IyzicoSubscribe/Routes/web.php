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

Route::prefix('iyzico-subscribe')->group(function() {
    Route::get('/', 'IyzicoSubscribeController@index');
});

Route::group([
    'middleware' =>[ 'web','impersonate'],
    'namespace' => 'Modules\IyzicoSubscribe\Http\Controllers'
], function () {
    Route::prefix('iyzicosubscribe')->group(function() {
        Route::get('/subscribe', 'Main@showUserForm')->name('iyzicosubscribe.userform');
        Route::post('/pay', 'Main@pay')->name('iyzicosubscribe.pay');
        Route::post('/callback', 'Main@callback')->name('iyzicosubscribe.callback');
    });
});

