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
use Modules\Analytics\Http\Controllers\Main;
    
Route::middleware(['web', 'auth'])->prefix('analytics')->group(function() {
    Route::get('/', [Main::class, 'index'])->name('analytics.index');
    Route::get('/export', [Main::class, 'export'])->name('analytics.export');
});
