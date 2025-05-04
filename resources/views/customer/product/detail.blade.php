@extends('customer.layout.app')

@section('content')
<div class="max-w-screen-xl mx-auto p-6 bg-white rounded-xl shadow mt-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Ảnh sản phẩm -->
        <div class="flex flex-col items-center">
            <!-- Ảnh chính -->
            <img id="main-image"
                 src="{{ asset('images/products/thumbnails/' . $product->thumbnail) }}"
                 alt="{{ $product->name }}"
                 class="w-full max-w-md object-contain rounded-lg">

            <!-- Ảnh nhỏ -->
            <div class="flex gap-2 mt-4">
                @foreach ($product->variants->pluck('color')->unique('id') as $color)
                    @php
                        $baseName = $product->slug;
                        $colorName = strtolower(str_replace(' ', '_', $color->name));
                        $imageName = $baseName . '_' . $colorName . '.png';
                        $imagePath = asset('images/products/variants/' . $baseName  . '/' . $imageName);
                    @endphp
                    <img src="{{ $imagePath }}"
                         alt="{{ $color->name }}"
                         class="w-16 h-16 object-contain rounded-lg shadow cursor-pointer hover:ring-2 ring-blue-400 variant-thumb"
                         data-image="{{ $imagePath }}">
                @endforeach
            </div>
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="flex flex-col space-y-4">
            <h1 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h1>

            @php
                $variant = $product->variants->first();
                $price = $variant?->price ?? 0;
                $discount = $variant?->discount ?? 0;
                $finalPrice = $price * (1 - $discount / 100);
            @endphp

            <!-- Giá -->
            <div class="text-xl font-semibold text-red-600">
                <span id="price-final">{{ number_format($finalPrice, 0, ',', '.') }}₫</span>
                @if ($discount > 0)
                    <span id="price-original" class="text-gray-500 line-through text-sm ml-2">{{ number_format($price, 0, ',', '.') }}₫</span>
                    <span id="discount-percent" class="ml-2 text-green-600 text-sm font-medium">-{{ $discount }}%</span>
                @else
                    <span id="price-original" class="text-gray-500 line-through text-sm ml-2"></span>
                    <span id="discount-percent" class="ml-2 text-green-600 text-sm font-medium"></span>
                @endif
            </div>

            <!-- Chọn màu sắc -->
            <div>
                <label class="block font-medium text-sm mb-1">Màu sắc:</label>
                <div class="flex flex-wrap gap-3">
                    @foreach ($product->variants->pluck('color')->unique('id') as $color)
                        @php
                            $baseName = $product->slug;
                            $colorName = strtolower(str_replace(' ', '_', $color->name));
                            $imageName = $baseName . '_' . $colorName . '.png';
                            $imagePath = asset('images/products/variants/' . $baseName  . '/' . $imageName);
                        @endphp

                        <button type="button"
                                class="color-option flex items-center gap-2 px-4 py-2 border rounded-full transition
                                    hover:bg-gray-100 text-sm"
                                style="border-color: #d1d5db;"
                                data-color="{{ $color->id }}"
                                data-image="{{ $imagePath }}"
                                data-hex="{{ $color->hex_code }}">
                            <span class="w-4 h-4 rounded-full" style="background-color: {{ $color->hex_code }}"></span>
                            {{ $color->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Chọn dung lượng -->
            <div>
                <label class="block font-medium text-sm mb-1">Dung lượng:</label>
                <div class="flex flex-wrap gap-3">
                    @foreach ($product->variants->pluck('storage')->unique('id') as $storage)
                        <button type="button"
                                class="storage-option px-4 py-2 border rounded-full transition text-sm
                                    hover:bg-gray-100"
                                style="border-color: #d1d5db;"
                                data-storage="{{ $storage->id }}">
                            {{ $storage->capacity }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Thêm vào giỏ hàng -->
            <form method="POST" action="">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit"
                        class="mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Thêm vào giỏ hàng
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let selectedColor = null;
    let selectedStorage = null;

    // Đổi ảnh chính khi chọn màu
    document.querySelectorAll('.color-option').forEach(btn => {
        btn.addEventListener('click', function () {
            // Xoá class active từ tất cả nút màu
            document.querySelectorAll('.color-option').forEach(b => {
                b.classList.remove('ring-2', 'ring-blue-500', 'bg-blue-50', 'text-blue-700', 'border-blue-500');
            });

            // Thêm class active vào nút được chọn
            this.classList.add('ring-2', 'ring-blue-500', 'bg-blue-50', 'text-blue-700', 'border-blue-500');

            selectedColor = this.dataset.color;
            const newImage = this.dataset.image;
            document.getElementById('main-image').src = newImage;

            updatePrice();
        });
    });


    // Đổi ảnh chính khi bấm ảnh nhỏ
    document.querySelectorAll('.variant-thumb').forEach(img => {
        img.addEventListener('click', function () {
            const newImage = this.dataset.image;
            document.getElementById('main-image').src = newImage;
        });
    });

    // Cập nhật giá khi chọn dung lượng
    document.querySelectorAll('.storage-option').forEach(btn => {
        btn.addEventListener('click', function () {
            // Xoá trạng thái đã chọn trước đó
            document.querySelectorAll('.storage-option').forEach(b => {
                b.classList.remove('ring-2', 'ring-blue-500', 'bg-blue-50', 'text-blue-700', 'border-blue-500');
            });

            // Thêm hiệu ứng chọn
            this.classList.add('ring-2', 'ring-blue-500', 'bg-blue-50', 'text-blue-700', 'border-blue-500');

            selectedStorage = this.dataset.storage;
            updatePrice();
        });
    });


    function updatePrice() {
        if (!selectedColor || !selectedStorage) return;

        const variants = @json($product->variants);

        const variant = variants.find(v =>
            v.color.id == selectedColor && v.storage.id == selectedStorage
        );

        if (variant) {
            const price = parseFloat(variant.price);
            const discount = parseFloat(variant.discount);
            const finalPrice = price * (1 - discount / 100);

            document.getElementById('price-final').innerText = finalPrice.toLocaleString('vi-VN') + '₫';
            if (discount > 0) {
                document.getElementById('price-original').innerText = price.toLocaleString('vi-VN') + '₫';
                document.getElementById('discount-percent').innerText = `-${discount}%`;
            } else {
                document.getElementById('price-original').innerText = '';
                document.getElementById('discount-percent').innerText = '';
            }
        }
    }
</script>
@endpush
