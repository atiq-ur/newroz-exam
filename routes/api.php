<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::resource('/product', \App\Http\Controllers\API\ProductApiController::class);
Route::resource('/product.tastes', \App\Http\Controllers\API\TasteApiController::class);
Route::resource('/product.tastes.utilities', \App\Http\Controllers\API\ProductDataApiController::class);
