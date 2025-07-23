<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

//Public Routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('getAllProducts', [ProductsController::class, 'index']);
Route::get('getProduct/{id}', [ProductsController::class, 'show']);


//Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('getAllRoles', [RolesController::class, 'index']);
    Route::post('createRole', [RolesController::class, 'store']);
    Route::get('getRole/{id}', [RolesController::class, 'show']);
    Route::put('updateRole/{id}', [RolesController::class, 'update']);
    Route::delete('deleteRole/{id}', [RolesController::class, 'destroy']);

    Route::post('createProduct', [ProductsController::class, 'store']);
    Route::put('updateProduct/{id}', [ProductsController::class, 'update']);
    Route::delete('deleteProduct/{id}', [ProductsController::class, 'destroy']);

    Route::get('getAllOrders', [OrdersController::class, 'index']);
    Route::post('createOrder', [OrdersController::class, 'store']);
    Route::get('getOrder/{id}', [OrdersController::class, 'show']);
    Route::put('updateOrder/{id}', [OrdersController::class, 'update']);
    Route::delete('deleteOrder/{id}', [OrdersController::class, 'destroy']);

    Route::get('getAllUsers', [UserController::class, 'index']);
    Route::post('createUser', [UserController::class, 'store']);
    Route::get('getUser/{id}', [UserController::class, 'show']);
    Route::put('updateUser/{id}', [UserController::class, 'update']);
    Route::delete('deleteUser/{id}', [UserController::class, 'destroy']);
});
