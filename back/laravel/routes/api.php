<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Ticket_ProductController;

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
    Route::post('ventas', [TicketsController::class, 'store']);
    Route::get('tickets', [TicketsController::class, 'index']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::post('cancelar/{id}', [TicketsController::class, 'cancel']);


    
    //Ruta para asociar producto vendido a ticket
    Route::post('tickets_product/{ticketId}', [Ticket_ProductController::class, 'store']);
    Route::get('tickets_product/{ticketId}', [Ticket_ProductController::class, 'index']);
});

//Ruta devolver todos los productos
Route::get('products', [ProductController::class, 'index']);

//Rutas para el login y registro de usuarios
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

