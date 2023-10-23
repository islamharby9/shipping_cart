<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//items
Route::get('items/index', [ItemController::class, 'index']);

//cart
Route::post('item/add', [CartController::class, 'store']);
Route::post('item/update', [CartController::class, 'update']);
Route::delete('item/delete/{item_id}', [CartController::class, 'destroy']);

//order
Route::get('order/show', [OrderController::class, 'show']);
Route::post('order/update', [OrderController::class, 'update']);
Route::delete('order/delete/{order_id}', [OrderController::class, 'destroy']);

//payment
Route::get('order/checkout', [OrderController::class, 'checkout']);
