<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{
    //
    public function getProductByCategory(Request $request, $category)
    {
        $category = Category::where('slug', $category)->first();
        
        $products = $category->products()->with(['variants', 'reviews'])->get();

        if ($request->has('sort')) {
            $products = $products->sortBy(function ($product) {
                return $product->variants->first()?->price ?? 0;
            }, SORT_REGULAR, $request->sort === 'desc');
        }

        $brandIds = $products->pluck('brand_id')->unique();
        $brands = Brand::whereIn('id', $brandIds)->get();
        return view('customer.product.category', compact('category', 'products', 'brands'));
    }

    public function getProductByCategoryAndBrand(Request $request, $category, $brand)
    {
        $category = Category::where('slug', $category)->first();
        
        $brand = Brand::where('name', $brand)->first();

        $categoryProducts = $category->products();
        $brandIds = $categoryProducts->pluck('brand_id')->unique();
        $brands = Brand::whereIn('id', $brandIds)->get();

        $products = Product::where('category_id', $category->id)
                            ->where('brand_id', $brand->id) 
                            ->with(['variants', 'reviews'])
                            ->get();

        if ($request->has('sort')) {
            $products = $products->sortBy(function ($product) {
                return $product->variants->first()?->price ?? 0;
            }, SORT_REGULAR, $request->sort === 'desc');
        }
        return view('customer.product.category', compact('category', 'brands', 'brand', 'products'));
    }

    public function getProductDetail($slug)
    {
        $product = Product::with(['variants', 'specifications', 'reviews'])->where('slug', $slug)->first();
        return view('customer.product.detail', compact('product'));
    }
}
