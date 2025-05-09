<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\ProductVariant;

class CartController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->get();
        $cartItems = Cart::where('user_id', $user->id)->with('productVariant')->get();

        $totalPrice = 0;
        $totalDiscount = 0;
        $totalPriceAfterDiscount = 0;

        foreach ($cartItems as $item) {
            $variant = $item->productVariant;
            if (!$variant) continue;

            $price = $variant->price;
            $discount = $variant->discount ?? 0;
            $priceAfterDiscount = $price * (1 - $discount / 100);

            $totalPrice += $price * $item->quantity;
            $totalPriceAfterDiscount += $priceAfterDiscount * $item->quantity;
        }

        $totalDiscount = $totalPrice - $totalPriceAfterDiscount;

        return view('customer.cart.index', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'totalDiscount' => $totalDiscount,
            'finalPrice' => $totalPriceAfterDiscount,
        ]);
    }
    public function addToCart(Request $request)
    {
        // Nếu chưa chọn màu sắc hoặc dung lượng
        if (!$request->filled('color_id') || !$request->filled('storage_id')) {
            return redirect()->back()->with('info', 'Vui lòng chọn đầy đủ màu sắc và dung lượng trước khi thêm vào giỏ hàng.');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'color_id' => 'required|exists:colors,id',
            'storage_id' => 'required|exists:storages,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $userId = Auth::id();
        $productId = $request->input('product_id');
        $colorId = $request->input('color_id');
        $storageId = $request->input('storage_id');
        $quantity = $request->input('quantity', 1);

        $variant = ProductVariant::where('product_id', $productId)
            ->where('color_id', $colorId)
            ->where('storage_id', $storageId)
            ->first();

        if (!$variant) {
            return back()->with('error', 'Không tìm thấy biến thể sản phẩm phù hợp.');
        }

        $cartItem = Cart::where('user_id', $userId)
            ->where('product_variant_id', $variant->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_variant_id' => $variant->id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }



    public function removeProductFromCart($id)
    {
        $user = Auth::user();
        $cartItem = Cart::where('user_id', $user->id)->where('product_variant_id', $id)->first();
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }
}
