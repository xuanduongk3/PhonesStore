<header class="bg-[#FFD500] shadow">
    <!-- Top Header: Logo - Navigation - Search - Actions -->
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 py-3 space-y-3 md:space-y-0">
        <!-- Logo + Navigation -->
        <div class="flex items-center space-x-8 flex-shrink-0">
            <!-- Logo -->
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="h-20 w-auto">
            </a>
            <!-- Navigation -->
            <nav class="hidden md:flex space-x-6 text-gray-800 font-medium">
                <a href="{{ url('/') }}" class="hover:text-blue-700">Trang chủ</a>
                <a href="{{ route('customer.product.index') }}" class="hover:text-blue-700">Sản phẩm</a>
                <a href="" class="hover:text-blue-700">Giới thiệu</a>
            </nav>
        </div>

        <!-- Search -->
        <div class="w-full md:flex-grow mx-0 md:mx-4 relative max-w-xl">
            <form action="{{ route('customer.product.search') }}" method="GET">
                @csrf
                <input type="text" name="search" placeholder="Tìm sản phẩm..."
                   class="w-full pl-10 pr-4 py-2 rounded-full bg-white text-gray-800 focus:outline-none shadow-sm" />
                <span class="absolute left-3 top-2.5 text-gray-400">
                    <i class="fas fa-search"></i>
                </span>
            </form>
        </div>

        <!-- Login & Cart -->
        <div class="flex space-x-6 text-sm">
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center text-gray-800 hover:text-blue-700 whitespace-nowrap focus:outline-none cursor-pointer">
                    <i class="fas fa-user mr-1"></i>
                    <span>
                        @if(Auth::check())
                            {{ Auth::user()->name }}
                        @else
                            Tài khoản
                        @endif
                    </span>
                </button>
            
                <!-- Dropdown menu -->
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 py-2 text-sm text-gray-700">
                    @if(Auth::check())
                        <a href="" class="block px-4 py-2 hover:bg-gray-100">Thông tin của tôi</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Đăng xuất</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-100">Đăng nhập</a>
                    @endif
                </div>
            </div>
            
            <a href="{{ route('cart.index') }}" class="flex items-center text-gray-800 hover:text-blue-700 whitespace-nowrap">
                <i class="fas fa-shopping-cart mr-1"></i> <span>Giỏ hàng</span>
            </a>
        </div>        
    </div>
</header>
