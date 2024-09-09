<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\SalesOrderDetailController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\UserController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::apiResource('products', ProductController::class);

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/user/details', [UserController::class, 'getUserDetails'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function () {
    Route::put('/user/number', [UserController::class, 'updateDetails']);
});

Route::middleware('auth:sanctum')->get('/user/address', [UserController::class, 'getUserAddress']);
Route::middleware('auth:sanctum')->post('/sales_order_details', [SalesOrderDetailController::class, 'store']);



Route::middleware(['web'])->group(function () {
    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
    Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
});

//route za profil stranicu
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'show']);
    Route::get('/addresses/{id}', [AddressController::class, 'show']);
    Route::post('/addresses', [AddressController::class, 'store']);
    Route::put('/addresses/{id}', [AddressController::class, 'update']);
});



Route::middleware(['auth:sanctum'])->group(function () {
    
        
        Route::get('admin/products', [ProductController::class, 'admin_index']);
        Route::post('admin/products', [ProductController::class, 'admin_store']);
        Route::get('admin/products/{product}', [ProductController::class, 'admin_show']);
        Route::put('admin/products/{product}', [ProductController::class, 'admin_update']);
        Route::delete('admin/products/{product}', [ProductController::class, 'admin_destroy']);

       
        Route::get('admin/addresses', [AddressController::class, 'admin_index']);
        Route::post('admin/addresses', [AddressController::class, 'admin_store']);
        Route::get('admin/addresses/{address}', [AddressController::class, 'admin_show']);
        Route::put('admin/addresses/{address}', [AddressController::class, 'admin_update']);
        Route::delete('admin/addresses/{address}', [AddressController::class, 'admin_destroy']);

        
        Route::get('admin/users', [UserController::class, 'admin_index']);
        Route::post('admin/users', [UserController::class, 'admin_store']);
        Route::get('admin/users/{user}', [UserController::class, 'admin_show']);
        Route::put('admin/users/{user}', [UserController::class, 'admin_update']);
        Route::delete('admin/users/{user}', [UserController::class, 'admin_destroy']);

      
        Route::get('admin/sales_order_details', [SalesOrderDetailController::class, 'admin_index']);
        Route::post('admin/sales_order_details', [SalesOrderDetailController::class, 'admin_store']);
        Route::get('admin/sales_order_details/{salesOrderDetail}', [SalesOrderDetailController::class, 'admin_show']);
        Route::put('admin/sales_order_details/{salesOrderDetail}', [SalesOrderDetailController::class, 'admin_update']);
        Route::delete('admin/sales_order_details/{salesOrderDetail}', [SalesOrderDetailController::class, 'admin_destroy']);
   
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('admin/products_count', [ProductController::class, 'admin_count']);
    Route::get('admin/addresses_count', [AddressController::class, 'admin_count']);
    Route::get('admin/users_count', [UserController::class, 'admin_count']);
    Route::get('admin/sales-order-details_count', [SalesOrderDetailController::class, 'admin_count']);
});