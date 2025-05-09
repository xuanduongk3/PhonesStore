<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');


//Route sản phẩm
Route::get('/products', [ProductController::class, 'getAllProducts'])->name('customer.product.index');
Route::get('/product/search', [ProductController::class, 'getProductBySearch'])->name('customer.product.search');
// Route chi tiết sản phẩm
Route::get('/product/{slug}', [ProductController::class, 'getProductDetail'])->name('customer.product.detail');


// Route thương hiệu
Route::get('/brand/{brandName}', [ProductController::class, 'getProductByBrand'])->name('customer.product.brand');

//Route khách hàng đăng nhập - đăng ký
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/signup', [AuthController::class, 'signup'])->name('signup');

Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/signup', [AuthController::class, 'signupPost'])->name('signup.post');

//
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/delete/{id}', [CartController::class, 'removeProductFromCart'])->name('cart.remove');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

