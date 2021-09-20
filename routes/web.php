<?php

use App\Http\Controllers\AdminExcelController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;


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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::get('/dashboard',[AdminExcelController::class, 'index'])->name('dashboard');
    Route::get('/importExcel',[AdminExcelController::class, 'importExcel'])->name('importExcel');
    Route::post('/postExcel', [AdminExcelController::class,'postExcel'])->name('postExcel');
});



//Route::group(['prefix' => 'admin'], function () {
//    Voyager::routes();
//});

Route::get('/{any}', function () {
    return view('layouts.vue');
})->where('any', '.*');



