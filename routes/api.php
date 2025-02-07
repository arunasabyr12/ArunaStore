<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Order;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/orders', [OrderController::class, 'store']);
Route::post('/orders', function (Request $request) {
    $order = Order::create($request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'address' => 'required|string',
        'phone' => 'required|string',
        'items' => 'required|array',
        'total_price' => 'required|numeric',
    ]));

    return response()->json(['message' => 'Заказ оформлен!', 'order' => $order], 201);
});
Route::get('/order', [OrderController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products{id}', [ProductController::class, 'destroy']);