<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'index']);

// Route danh mục
Route::prefix('danh-muc')->group(function() {
    Route::get('/{category}', [ProductController::class, 'getProductByCategory'])->name('customer.product.category');
    Route::get('/{category}/{brand}', [ProductController::class, 'getProductByCategoryAndBrand'])->name('customer.product.category.brand');
});

// Route chi tiết sản phẩm (giữ nguyên)
Route::get('/product/{slug}', [ProductController::class, 'getProductDetail'])->name('customer.product.detail');

