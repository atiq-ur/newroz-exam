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
Route::get('/orders/products', [\App\Http\Controllers\Backend\OrderController::class, 'index'])->name('order.index');
Route::get('/orders/{name}', [\App\Http\Controllers\Backend\OrderController::class, 'details'])->name('order.details');
Route::post('/orders/product/taste/utilities/cart', [\App\Http\Controllers\Backend\OrderController::class, 'cart'])->name('order.cart');
Route::get('/orders/product/taste/utilities/cart/view', [\App\Http\Controllers\Backend\OrderController::class, 'cartView'])->name('order.cart.view');
Route::post('/orders/product/order/confirm', [\App\Http\Controllers\Backend\OrderController::class, 'place_order'])->name('order.place.confirm');
Route::get('/invoice', [\App\Http\Controllers\Backend\OrderController::class, 'invoice'])->name('invoice');

//Manage Orders
Route::get('/manage-orders', [\App\Http\Controllers\Backend\OrderController::class, 'orderLists'])->name('order.lists');
Route::get('/manage-orders/view/{order}', [\App\Http\Controllers\Backend\OrderController::class, 'orderView'])->name('order.view');
Route::put('/manage-orders/confirm/{order_id}', [\App\Http\Controllers\Backend\OrderController::class, 'orderConfirm'])->name('order.confirm');
Route::put('/manage-orders/cancel/{order_id}', [\App\Http\Controllers\Backend\OrderController::class, 'orderCancel'])->name('order.cancel');
Route::put('/manage-orders/isDelivered/{order_id}', [\App\Http\Controllers\Backend\OrderController::class, 'isDelivered'])->name('order.isDelivered');
Route::get('/manage-orders/delete/{order_id}', [\App\Http\Controllers\Backend\OrderController::class, 'destroyOrder'])->name('order.destroy');
