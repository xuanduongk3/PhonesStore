@extends('customer.layout.app')

@section('title', 'Giỏ hàng')

@section('content')
<div class="container mx-auto px-4 py-8 min-h-screen">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Giỏ hàng của bạn</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Danh sách sản phẩm --}}
        <div class="lg:col-span-2">
            @forelse ($cartItems as $item)
                <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden transition duration-300 hover:shadow-lg">
                    <div class="flex flex-col md:flex-row p-6">
                        <div class="flex-shrink-0 mb-4 md:mb-0 md:mr-6">
                            <img src="{{ asset('images/products/variants/' . $item->productVariant->product->slug . '/' . $item->productVariant->image) }}" 
                                alt="{{ $item->productVariant->product->name }}" 
                                class="w-24 h-24 object-cover rounded-lg">
                        </div>
                        <div class="flex-grow">
                            <div class="flex flex-col md:flex-row md:justify-between">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800 mb-1">{{ $item->productVariant->product->name }}</h2>
                                    <div class="flex flex-wrap gap-2 mb-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $item->productVariant->color->title }}
                                        </span>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            {{ $item->productVariant->storage->capacity }}
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-2 md:mt-0 text-right">
                                    @php
                                        $price = $item->productVariant->price;
                                        $discount = $item->productVariant->discount ?? 0;
                                        $priceAfterDiscount = $price * (1 - $discount / 100);
                                    @endphp
                                
                                    @if ($discount > 0)
                                        <p class="text-sm text-gray-500 line-through">{{ number_format($price) }}₫</p>
                                        <p class="text-lg font-bold text-red-600">{{ number_format($priceAfterDiscount) }}₫</p>
                                    @else
                                        <p class="text-lg font-bold text-red-600">{{ number_format($price) }}₫</p>
                                    @endif
                                </div>
                                
                            </div>
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between mt-4">
                                <div class="inline-flex items-center rounded-md overflow-hidden">
                                    <button type="button" onclick="decrementQuantity({{ $item->id }})" 
                                        class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                        </svg>
                                    </button>
                                    <input type="number" id="quantity-{{ $item->id }}" name="quantity[{{ $item->id }}]" value="{{ $item->quantity }}" min="1" 
                                        class="w-14 text-center focus:outline-none py-2 px-2 text-gray-700" readonly>
                                    <button type="button" onclick="incrementQuantity({{ $item->id }})" 
                                        class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </div>
                                <button class="mt-3 md:mt-0 inline-flex items-center text-gray-500 hover:text-red-600 transition duration-300"
                                    onclick="removeItem({{ $item->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m5-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span>Xóa</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-12 bg-white rounded-lg shadow-md">
                    <img src="{{ asset('images/cart/empty-cart.png') }}" alt="Giỏ hàng trống" class="w-64 mb-6">
                    <h3 class="text-2xl font-medium text-gray-700 mb-4">Giỏ hàng của bạn đang trống</h3>
                    <p class="text-gray-500 mb-6">Hãy thêm sản phẩm vào giỏ hàng để tiếp tục</p>
                    <a href="" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-300">
                        Bắt đầu mua sắm
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Tóm tắt đơn hàng --}}
        @if(count($cartItems) > 0)
            <div class="bg-white rounded-lg shadow-md p-6 h-fit sticky top-4">
                <h2 class="text-xl font-bold text-gray-800 mb-6 pb-4 border-b border-gray-200">Tóm tắt đơn hàng</h2>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Tổng giá sản phẩm:</span>
                        <span class="font-medium">{{ number_format($totalPrice) }}₫</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Tổng giảm giá:</span>
                        <span class="font-medium text-green-600">-{{ number_format($totalDiscount) }}₫</span>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-800">Tổng thanh toán:</span>
                            <span class="text-xl font-bold text-red-600">{{ number_format($finalPrice) }}₫</span>
                        </div>
                    </div>
                    
                    <div class="mt-2 text-xs text-gray-500">
                        <p>* Giá chưa bao gồm phí vận chuyển</p>
                    </div>
                    
                    <a href="" class="mt-6 block w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-center transition duration-300 transform hover:-translate-y-1">
                        Tiến hành đặt hàng
                    </a>
                    
                    <div class="flex items-center justify-center mt-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span class="text-sm text-gray-600">Thanh toán an toàn</span>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection