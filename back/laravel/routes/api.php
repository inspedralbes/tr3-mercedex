<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\UserController;

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

Route::group(['middleware' => ['auth:sanctum']], function () {

});

//Ruta devolver todos los productos
Route::get('products', [ProductController::class, 'index']);

//Ruta para vender un producto
Route::post('ventas', [TicketsController::class, 'store']);

//Rutas para el login y registro de usuarios
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

