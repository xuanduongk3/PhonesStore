<footer class="bg-gray-100 mt-10 py-10 border-t border-gray-200 text-sm text-gray-700">
    <div class="max-w-screen-xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-6">

        <!-- Cột 1: Tổng đài hỗ trợ -->
        <div>
            <h3 class="font-semibold mb-3">Tổng đài hỗ trợ</h3>
            <p>Gọi mua: <span class="font-medium text-gray-900">1900 1234</span></p>
            <p>Khiếu nại: <span class="font-medium text-gray-900">1900 5678</span></p>
            <p>Bảo hành: <span class="font-medium text-gray-900">1900 9101</span></p>
        </div>

        <!-- Cột 2: Về chúng tôi -->
        <div>
            <h3 class="font-semibold mb-3">Về chúng tôi</h3>
            <ul class="space-y-1">
                <li><a href="#" class="hover:text-blue-600">Giới thiệu</a></li>
                <li><a href="#" class="hover:text-blue-600">Gửi góp ý, khiếu nại</a></li>
            </ul>
        </div>

        <!-- Cột 3: Thông tin khác -->
        <div>
            <h3 class="font-semibold mb-3">Thông tin khác</h3>
            <ul class="space-y-1">
                <li><a href="#" class="hover:text-blue-600">Chính sách bảo hành</a></li>
                <li><a href="#" class="hover:text-blue-600">Chính sách đổi trả</a></li>
                <li><a href="#" class="hover:text-blue-600">Giao hàng & Thanh toán</a></li>
                <li><a href="#" class="hover:text-blue-600">Chính sách xử lý dữ liệu cá nhân</a></li>
            </ul>
        </div>

        <!-- Cột 4: Logo & Mạng xã hội -->
        <div class="flex flex-col items-center md:items-end">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Logo Shop" class="h-20 w-auto">
            <div class="flex space-x-4 text-xl">
                <a href="#" class="hover:text-blue-600"><i class="fab fa-facebook-square"></i></a>
                <a href="#" class="hover:text-red-600"><i class="fab fa-youtube"></i></a>
                <a href="#" class="hover:text-black"><i class="fab fa-tiktok"></i></a>
            </div>
            {{-- <div class="flex space-x-4 mt-4 text-xl">
                <i class="fas fa-university" title="VNPay"></i>
                <i class="fas fa-truck" title="Giao Hàng Nhanh"></i>
            </div> --}}
        </div>
    </div>
</footer>
