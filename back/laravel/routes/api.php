<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TicketsController;

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
//Ruta devolver todos los productos
Route::get('products', [ProductController::class, 'index']);
//Ruta para vender un producto
Route::put('ventas', [ProductController::class, 'update']);
// Ruta para devolver todos los tickets
Route::get('tickets', [TicketsController::class, 'index']);
// Ruta para crear un nuevo ticket
Route::post('tickets', [TicketsController::class, 'store']);
