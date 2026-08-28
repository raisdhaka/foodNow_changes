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


Route::group([
    'middleware' => ['web','impersonate'],
    'namespace' => 'Modules\Photos\Http\Controllers'
], function () {
    Route::prefix('photos')->group(function() {
        // Main route
        Route::get('/', 'PhotosController@index')->name('photos.index');
        
        // Album routes
        Route::prefix('albums')->name('photos.albums.')->group(function() {
            Route::get('/', 'PhotosController@index')->name('index');
            Route::get('/create', 'PhotosController@createAlbum')->name('create');
            Route::post('/', 'PhotosController@storeAlbum')->name('store');
            Route::get('/{slug}', 'PhotosController@albums')->name('show');
            Route::get('/{album}/edit', 'PhotosController@editAlbum')->name('edit');
            Route::put('/{album}', 'PhotosController@updateAlbum')->name('update');
            Route::get('/del/{album}', 'PhotosController@destroyAlbum')->name('delete');
            Route::get('/{album}/import-menu-images', 'PhotosController@importMenuImages')->name('import-menu-images');
            Route::post('/order', 'PhotosController@updateAlbumOrder')->name('order.update');
        });
        
        // Photo routes
        Route::prefix('photos')->name('photos.')->group(function() {
            Route::post('/upload/{albumId}', 'PhotosController@uploadPhotos')->name('upload');
            Route::put('/{photo}', 'PhotosController@updatePhoto')->name('update');
            Route::get('/del/{photo}', 'PhotosController@deletePhoto')->name('delete');
            Route::post('/order', 'PhotosController@updatePhotoOrder')->name('order.update');
        });
    });
});
