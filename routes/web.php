<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::resource('products', ProductController::class);
use App\Http\Controllers\StockMovementController;

Route::post('products/{product}/stock', [StockMovementController::class, 'store'])->name('products.stock.store');