<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [\App\Http\Controllers\Backend\PagesController::class, 'index'])->name('admin.index');
Route::resource('/products', \App\Http\Controllers\Backend\ProductController::class);
Route::resource('/products.tastes', \App\Http\Controllers\Backend\TasteController::class);
Route::resource('/products.tastes.utilities', \App\Http\Controllers\Backend\ProductDataController::class);
