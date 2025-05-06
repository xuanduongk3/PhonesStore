<header class="bg-[#FFD500] shadow">
    <!-- Top Header: Logo - Search - Actions -->
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 py-3 space-y-3 md:space-y-0">
        <!-- Logo -->
        <div class="flex-shrink-0">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="h-20 w-auto">
            </a>
        </div>

        <!-- Search -->
        <div class="w-full md:flex-grow mx-0 md:mx-4 relative max-w-xl">
            <input type="text" placeholder="Tìm sản phẩm..."
                   class="w-full pl-10 pr-4 py-2 rounded-full bg-white text-gray-800 focus:outline-none shadow-sm" />
            <span class="absolute left-3 top-2.5 text-gray-400">
                <i class="fas fa-search"></i>
            </span>
        </div>

        <!-- Login & Cart -->
        <div class="flex space-x-6 text-sm">
            <a href="#" class="flex items-center text-gray-800 hover:text-blue-700 whitespace-nowrap">
                <i class="fas fa-user mr-1"></i> <span>Đăng nhập</span>
            </a>
            <a href="#" class="flex items-center text-gray-800 hover:text-blue-700 whitespace-nowrap">
                <i class="fas fa-shopping-cart mr-1"></i> <span>Giỏ hàng</span>
            </a>
        </div>
    </div>
    
</header>
