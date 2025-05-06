<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'index']);

// Route thương hiệu
Route::get('/brand/{brandName}', [ProductController::class, 'getProductByBrand'])->name('customer.product.brand');

// Route chi tiết sản phẩm (giữ nguyên)
Route::get('/product/{slug}', [ProductController::class, 'getProductDetail'])->name('customer.product.detail');

