@extends('customer.layout.app')

@section('content')

<style>
    .banner-slider {
        margin-top: 0;
        position: relative;
    }

    .swiper-container {
        width: 100%;
        overflow: hidden;
    }

    .swiper-slide {
        padding: 0; /* Không padding bên trong slide */
        box-sizing: border-box;
    }

    .swiper-slide img {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 12px; /* Bo góc ảnh */
        object-fit: cover;
    }
</style>

<!-- Banner Slider -->
<section class="banner-slider">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="swiper-slide">
                        <img src="{{ asset('images/banners/' . $banner->image) }}" alt="Banner">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Nội dung trang chính -->
<div class="content mt-8">

    <!-- Sản phẩm nổi bật -->
    <div class="w-full max-w-screen-xl mx-auto px-4 mb-10 bg-white rounded-2xl shadow p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Sản phẩm nổi bật</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            @foreach ($featuredProducts as $product)
                <div class="border rounded-2xl p-4 bg-white border-[#EAECF0] transform transition duration-300 hover:scale-105 shadow-sm">
                    <a href="{{ route('customer.product.detail', ['slug' => $product->slug]) }}">
                        <img src="{{ asset('images/products/thumbnails/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="w-full h-40 object-contain mb-3 rounded-xl">
                    </a>
                    <h3 class="text-base font-medium text-gray-900 truncate">{{ $product->name }}</h3>

                    @php
                        $variant = $product->variants->first();
                        $price = $variant?->price ?? 0;
                        $discount = $variant?->discount ?? 0;
                        $finalPrice = $price * (1 - $discount / 100);
                    @endphp

                    <div class="flex items-center mt-1">
                        @if ($discount > 0)
                            <p class="text-sm line-through text-gray-500 mr-2">
                                {{ number_format($price, 0, ',', '.') }}₫
                            </p>
                            <span class="text-green-500 text-sm font-medium">-{{ $discount }}%</span>
                        @endif
                    </div>

                    <p class="text-red-600 font-semibold text-base mt-1">
                        {{ number_format($finalPrice, 0, ',', '.') }}₫
                    </p>

                    <div class="flex items-center mt-2 text-sm text-yellow-500">
                        @php
                            $rating = $product->reviews()->avg('rating');
                            $rating = $rating ? round($rating) : 0;
                        @endphp
                        @for ($i = 0; $i < 5; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $i < $rating ? 'fill-yellow-400' : 'fill-gray-300' }}" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.973a1 1 0 00.95.69h4.184c.969 0 1.371 1.24.588 1.81l-3.388 2.462a1 1 0 00-.364 1.118l1.286 3.973c.3.921-.755 1.688-1.54 1.118l-3.388-2.462a1 1 0 00-1.176 0l-3.388 2.462c-.784.57-1.838-.197-1.54-1.118l1.286-3.973a1 1 0 00-.364-1.118L2.04 9.4c-.783-.57-.38-1.81.588-1.81h4.183a1 1 0 00.951-.69l1.286-3.973z" />
                            </svg>
                        @endfor
                        <span class="text-gray-500 ml-2">({{ number_format($rating, 1) }})</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Thương hiệu --}}
    <div class="w-full max-w-screen-xl mx-auto px-4 mb-10 bg-white rounded-2xl shadow p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Thương hiệu</h2>
    
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($brands as $brand)
                <a href="{{ route('customer.product.brand', ['brandName' => $brand->name]) }}"
                   class="border border-gray-200 rounded-lg p-4 flex items-center justify-center hover:shadow-md hover:border-blue-400 transition">
                    <img src="{{ asset('images/brands/' . $brand->logo) }}"
                         alt="{{ $brand->name }}"
                         class="h-16 object-contain">
                </a>
            @endforeach
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 0, // Không khoảng cách giữa các slide, ảnh sẽ bo góc trong container
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        allowTouchMove: true, // Cho phép swipe
    });
</script>
@endpush
