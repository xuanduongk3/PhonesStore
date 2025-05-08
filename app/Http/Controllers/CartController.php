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
}
