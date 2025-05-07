<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route thương hiệu
Route::get('/brand/{brandName}', [ProductController::class, 'getProductByBrand'])->name('customer.product.brand');

// Route chi tiết sản phẩm (giữ nguyên)
Route::get('/product/{slug}', [ProductController::class, 'getProductDetail'])->name('customer.product.detail');

//Route khách hàng đăng nhập - đăng ký
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/signup', [AuthController::class, 'signup'])->name('signup');

Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/signup', [AuthController::class, 'signupPost'])->name('signup.post');

//
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

