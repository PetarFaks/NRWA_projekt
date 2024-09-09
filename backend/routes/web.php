<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AddressController;

use App\Http\Controllers\SalesOrderDetailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('products', ProductController::class);
Route::resource('addresses', AddressController::class);


Route::resource('sales_order_details', SalesOrderDetailController::class);

