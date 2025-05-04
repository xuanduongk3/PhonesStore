<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\Banner;

class HomeController extends Controller
{
    //
    public function index()
    {
        // ID sản phẩm nổi bật (tuỳ chỉnh theo ý bạn)
        $featuredIds = [1, 2, 3, 4, 5];

        // Lấy danh sách sản phẩm nổi bật
        $featuredProducts = Product::with(['variants', 'reviews'])->whereIn('id', $featuredIds)->get();

        $banners = Banner::all();
        return view('home', compact('featuredProducts', 'banners'));
    }
}
