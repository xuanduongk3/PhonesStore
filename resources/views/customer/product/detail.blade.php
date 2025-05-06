@extends('customer.layout.app')

@section('content')

<div class="max-w-screen-xl mx-auto p-6 rounded-xl">
    <!-- Content sản phẩm -->
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Ảnh sản phẩm -->
        <div class="w-full md:w-2/5">
            <div class="sticky top-6 self-start">
                <div class="rounded-lg shadow bg-white p-6 w-full flex flex-col items-center">
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

                    <div class="mt-6 w-full space-y-3 text-sm text-gray-700">
                        <div class="flex items-start gap-2">
                            <span><strong>MobilePhone Store cam kết</strong></span>
                        </div>
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 13l4 4L19 7" /></svg>
                            <span>Sản phẩm mới (cần thanh toán trước khi mở hộp)</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 13l4 4L19 7" /></svg>
                            <span>Thời gian giao hàng nhanh chóng và uy tín</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 13l4 4L19 7" /></svg>
                            <span>Bảo hành tại các trung tâm bảo hành chính hãng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Phần phải: thông tin sản phẩm + tab -->
        <div class="w-full md:w-3/5 flex flex-col space-y-4">
            <!-- Thông tin sản phẩm -->
            @php
                $colorVariants = $product->variants->pluck('color')->unique('id');
                $storageVariants = $product->variants->pluck('storage')->unique('id');

                $hasColorVariants = $colorVariants->isNotEmpty();
                $hasStorageVariants = $storageVariants->isNotEmpty();
            @endphp

            <!-- THÔNG TIN BÊN PHẢI -->
            <div class="rounded-lg shadow bg-white p-6">
                <h1 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h1>

                @php
                    $variant = $product->variants->first();
                    $price = $variant?->price ?? 0;
                    $discount = $variant?->discount ?? 0;
                    $finalPrice = $price * (1 - $discount / 100);
                @endphp

                <!-- Giá -->
                <div class="mt-2 text-xl font-semibold text-red-600">
                    <span id="price-final">{{ number_format($finalPrice, 0, ',', '.') }}₫</span>
                    @if ($discount > 0)
                        <span id="price-original" class="text-gray-500 line-through text-sm ml-2">{{ number_format($price, 0, ',', '.') }}₫</span>
                        <span id="discount-percent" class="ml-2 text-green-600 text-sm font-medium">-{{ $discount }}%</span>
                    @endif
                </div>

                <!-- MÀU SẮC -->
                @if ($hasColorVariants)
                    <div class="mt-3">
                        <label class="block font-medium text-sm mb-1">Màu sắc:</label>
                        <div class="flex flex-wrap gap-3">
                            @foreach ($colorVariants as $color)
                                @php
                                    $colorName = strtolower(str_replace(' ', '_', $color->name));
                                    $imageName = $product->slug . '_' . $colorName . '.png';
                                    $imagePath = asset('images/products/variants/' . $product->slug . '/' . $imageName);
                                @endphp

                                <button type="button"
                                        class="color-option flex items-center gap-2 px-4 py-2 border rounded-full transition hover:bg-gray-100 text-sm"
                                        style="border-color: #d1d5db;"
                                        data-color="{{ $color->id }}"
                                        data-image="{{ $imagePath }}"
                                        data-hex="{{ $color->hex_code }}">
                                    <span class="w-4 h-4 rounded-full" style="background-color: {{ $color->hex_code }}"></span>
                                    {{ $color->title }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- DUNG LƯỢNG -->
                @if ($hasStorageVariants)
                    <div class="mt-3">
                        <label class="block font-medium text-sm mb-1">Dung lượng:</label>
                        <div class="flex flex-wrap gap-3">
                            @foreach ($storageVariants as $storage)
                                <button type="button"
                                        class="storage-option px-4 py-2 border rounded-full transition text-sm hover:bg-gray-100 {{ $loop->first ? 'ring-2 ring-blue-500 bg-blue-50 text-blue-700 border-blue-500' : '' }}"
                                        style="border-color: #d1d5db;"
                                        data-storage="{{ $storage->id }}">
                                    {{ $storage->capacity }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Thêm vào giỏ -->
                <form method="POST" action="">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit"
                            class="mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                        Thêm vào giỏ hàng
                    </button>
                </form>
            </div>


            <!-- Tabs bên dưới thông tin -->
            <div class="rounded-lg shadow bg-white p-6">
                <div class="flex gap-4 mb-4 justify-center">
                    <button id="tab-specs"
                            class="tab-button px-5 py-2 text-sm font-medium rounded-full border transition text-blue-600 border-blue-600 cursor-pointer">
                        Thông số kỹ thuật
                    </button>
                    <button id="tab-reviews"
                            class="tab-button px-5 py-2 text-sm font-medium rounded-full border transition cursor-pointer">
                        Bài viết đánh giá
                    </button>
                </div>

                <div id="tab-content-specs" class="tab-content">
                    <table class="w-full text-sm text-left text-gray-700">
                        <tbody>
                            @foreach ($product->specifications as $spec)
                                <tr class="border-b border-gray-200">
                                    <th class="px-4 py-2 font-medium w-1/4">{{ $spec->key }}</th>
                                    <td class="px-4 py-2">{!! nl2br(e($spec->value)) !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div id="tab-content-reviews" class="tab-content hidden">
                    <div class="text-sm text-gray-700 space-y-2">
                        <p>{{ $product->long_description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Đánh giá sản phẩm --}}
    <div class="w-full max-w-screen-xl mx-auto px-4 mb-10 bg-white rounded-2xl shadow p-6 mt-10">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Đánh giá của người dùng</h2>
        <div class="mb-6">
            <div class="text-xl font-semibold text-gray-800">
                <span class="text-yellow-400">★</span> {{ $averageRating }}/5
            </div>
            {{-- <div class="text-sm text-gray-600">
                Dựa trên {{ $ratingCount }} đánh giá
            </div> --}}
        
            <div class="mt-3 space-y-1">
                @for ($i = 5; $i >= 1; $i--)
                    <div class="flex items-center text-sm text-gray-700">
                        <span class="w-6 text-right">{{ $i }} <span class="text-yellow-400">★</span></span>
                        <div class="h-2 bg-gray-200 rounded w-48 mx-2 relative">
                            @php
                                $percent = $ratingCount > 0 ? ($ratingBreakdown[$i] / $ratingCount) * 100 : 0;
                            @endphp
                            <div class="h-2 bg-yellow-400 rounded absolute top-0 left-0" style="width: {{ $percent }}%"></div>
                        </div>
                        <span class="w-6 text-right">{{ $ratingBreakdown[$i] }}</span>
                    </div>
                @endfor
            </div>
        </div>
        
        @forelse ($product->reviews as $review)
            <div class="border-b border-gray-200 py-4">
                <!-- Tên người dùng -->
                <div class="font-semibold text-gray-800 text-base">
                    {{ $review->user->name ?? 'Người dùng ẩn danh' }}
                </div>
    
                <!-- Sao đánh giá -->
                <div class="text-yellow-500 text-sm flex items-center gap-1 mt-1 mb-2">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $review->rating)
                            <span>★</span>
                        @else
                            <span class="text-gray-300">★</span>
                        @endif
                    @endfor
                    <span class="text-gray-500 text-xs ml-2">({{ $review->rating }}/5)</span>
                </div>
    
                <!-- Bình luận -->
                <div class="text-sm text-gray-700 whitespace-pre-line">
                    {{ $review->comment }}
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-sm">Chưa có đánh giá nào cho sản phẩm này.</p>
        @endforelse
    </div>
    
    <!-- Sản phẩm liên quan -->
    <div class="w-full max-w-screen-xl mx-auto px-4 mb-10 bg-white rounded-2xl shadow p-6 mt-10">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Sản phẩm liên quan</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            @foreach ($otherProducts as $pr)
                <div class="border rounded-2xl p-4 bg-white border-[#EAECF0] transform transition duration-300 hover:scale-105 shadow-sm">
                    <a href="{{ route('customer.product.detail', ['slug' => $pr->slug]) }}">
                        <img src="{{ asset('images/products/thumbnails/' . $pr->thumbnail) }}" alt="{{ $pr->name }}" class="w-full h-40 object-contain mb-3 rounded-xl">
                    </a>
                    <h3 class="text-base font-medium text-gray-900 truncate">{{ $pr->name }}</h3>

                    @php
                        $v = $pr->variants->first();
                        $pri = $v?->price ?? 0;
                        $dis = $v?->discount ?? 0;
                        $fPri = $pri * (1 - $dis / 100);
                    @endphp

                    <div class="flex items-center mt-1">
                        @if ($dis > 0)
                            <p class="text-sm line-through text-gray-500 mr-2">
                                {{ number_format($pri, 0, ',', '.') }}₫
                            </p>
                            <span class="text-green-500 text-sm font-medium">-{{ $dis }}%</span>
                        @endif
                    </div>

                    <p class="text-red-600 font-semibold text-base mt-1">
                        {{ number_format($fPri, 0, ',', '.') }}₫
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
</div>

@endsection

@push('scripts')
<script>
    let selectedColor = null;
    let selectedStorage = null;

    // Đổi ảnh chính khi chọn màu
    document.querySelectorAll('.color-option').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.color-option').forEach(b => {
                b.classList.remove('ring-2', 'ring-blue-500', 'bg-blue-50', 'text-blue-700', 'border-blue-500');
            });

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
            if (newImage) {
                document.getElementById('main-image').src = newImage;
            } else {
                console.error('Không tìm thấy data-image');
            }
        });
    });

    // Cập nhật giá khi chọn dung lượng
    document.querySelectorAll('.storage-option').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.storage-option').forEach(b => {
                b.classList.remove('ring-2', 'ring-blue-500', 'bg-blue-50', 'text-blue-700', 'border-blue-500');
            });

            this.classList.add('ring-2', 'ring-blue-500', 'bg-blue-50', 'text-blue-700', 'border-blue-500');

            selectedStorage = this.dataset.storage;
            updatePrice();
        });
        // Chọn mặc định nút dung lượng đầu tiên
        const firstStorageBtn = document.querySelector('.storage-option');
        if (firstStorageBtn) {
            firstStorageBtn.click(); // Kích hoạt sự kiện click để gán selectedStorage và cập nhật giá
        }

    });

    function updatePrice() {
        const variants = @json($product->variants);

        let variant = null;

        if (selectedColor && selectedStorage) {
            variant = variants.find(v => v.color.id == selectedColor && v.storage.id == selectedStorage);
        } else if (selectedColor) {
            variant = variants.find(v => v.color.id == selectedColor);
        } else if (selectedStorage) {
            variant = variants.find(v => v.storage.id == selectedStorage);
        }

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
        } else {
            // Nếu không tìm thấy variant phù hợp, có thể xóa giá hoặc hiển thị mặc định
            document.getElementById('price-final').innerText = 'Không có giá';
            document.getElementById('price-original').innerText = '';
            document.getElementById('discount-percent').innerText = '';
        }
    }
</script>


<script>
    // Xử lý tab chuyển đổi
    document.getElementById('tab-specs').addEventListener('click', function () {
        // Toggle active class
        this.classList.add('text-blue-600', 'border-blue-600');
        this.classList.remove('text-gray-600');
        document.getElementById('tab-reviews').classList.remove('text-blue-600', 'border-blue-600');
        document.getElementById('tab-reviews').classList.add('text-gray-600');

        // Hiện thông số kỹ thuật, ẩn đánh giá
        document.getElementById('tab-content-specs').classList.remove('hidden');
        document.getElementById('tab-content-reviews').classList.add('hidden');
    });

    document.getElementById('tab-reviews').addEventListener('click', function () {
        // Toggle active class
        this.classList.add('text-blue-600', 'border-blue-600');
        this.classList.remove('text-gray-600');
        document.getElementById('tab-specs').classList.remove('text-blue-600', 'border-blue-600');
        document.getElementById('tab-specs').classList.add('text-gray-600');

        // Hiện bài đánh giá, ẩn thông số
        document.getElementById('tab-content-specs').classList.add('hidden');
        document.getElementById('tab-content-reviews').classList.remove('hidden');
    });
</script>

@endpush
