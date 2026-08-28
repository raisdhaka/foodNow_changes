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

use Illuminate\Support\Facades\Route;
use Modules\Themeswitcher\Http\Controllers\MenuDesignController;



// Menu Design Routes
Route::group([
    'middleware' => ['web', 'auth']
], function () {
    Route::get('/menu_design', [MenuDesignController::class, 'index'])->name('themeswitcher.menu_design');
    Route::post('/menu_design/update', [MenuDesignController::class, 'updateTemplate'])->name('themeswitcher.menu_design.update');
});
