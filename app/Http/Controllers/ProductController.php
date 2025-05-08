<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Brand;

class ProductController extends Controller
{
    //

    public function getAllProducts()
    {
        $products = Product::with(['variants', 'specifications', 'reviews'])->get();
        return view('customer.product.index', ['products' => $products]);
    }

    public function getProductBySearch(Request $request)
    {
        $search = $request->search;
        if($request->has('search') && $request->search != ''){
            $products = Product::with(['variants', 'specifications', 'reviews'])
            ->where('name', 'like', '%'.$request->search.'%')
            ->get();
        }
        else{
            $products = Product::with(['variants', 'specifications', 'reviews'])->get();
        }

        return view('customer.product.index', ['products' => $products, 'search' => $search]);
    }
    public function getProductByBrand(Request $request, $brandName)
    {
        $brands = Brand::all();

        // Lấy thương hiệu theo tên (brand name)
        $brand = Brand::where('name', $brandName)->firstOrFail();

        // Lọc sản phẩm theo brand
        $productsQuery = Product::with(['variants', 'specifications', 'reviews'])
            ->where('brand_id', $brand->id);

        // Xử lý sắp xếp nếu có
        if ($request->has('sort')) {
            $products = $productsQuery->get()->sortBy(function ($product) {
                return $product->variants->first()?->price ?? 0;
            }, SORT_REGULAR, $request->sort === 'desc');
        } else {
            $products = $productsQuery->get();
        }

        // URL sắp xếp
        $sortUrl = route('customer.product.brand', ['brandName' => $brand->name]);

        return view('customer.product.brand', [
            'brands' => $brands,
            'brand' => $brand,
            'products' => $products,
            'sortUrl' => $sortUrl
        ]);
    }


    public function getProductDetail($slug)
    {
        $product = Product::with(['variants', 'specifications', 'reviews'])->where('slug', $slug)->first();
        $otherProducts = Product::with(['variants', 'specifications', 'reviews'])->where('brand_id', $product->brand_id)->where('id', '!=', $product->id)->get();
        $reviews = $product->reviews;

        $averageRating = round($reviews->avg('rating'), 1);
        $ratingCount = $reviews->count();

        $ratingBreakdown = [
            5 => $reviews->where('rating', 5)->count(),
            4 => $reviews->where('rating', 4)->count(),
            3 => $reviews->where('rating', 3)->count(),
            2 => $reviews->where('rating', 2)->count(),
            1 => $reviews->where('rating', 1)->count(),
        ];

        return view('customer.product.detail', compact('product', 'otherProducts', 'averageRating', 'ratingCount', 'ratingBreakdown'));
    }
}
