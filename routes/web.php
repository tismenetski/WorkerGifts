<?php

use App\Http\Controllers\AdminExcelController;
use App\Http\Controllers\GiftController;
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
    Route::get('/gifts',[GiftController::class,'index'])->name('availableGifts');
    Route::get('/gifts/addGift', [GiftController::class,'create'])->name('addGift');
    Route::post('/gifts/addGift',[GiftController::class,'store'])->name('storeGift');
    Route::get('/gifts/editGift/{id}',[GiftController::class,'edit'])->name('editGift');

});



//Route::group(['prefix' => 'admin'], function () {
//    Voyager::routes();
//});

Route::get('/{any}', function () {
    return view('layouts.vue');
})->where('any', '.*');



