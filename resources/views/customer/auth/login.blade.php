@extends('customer.layout.app')

@section('title', 'Đăng nhập')
@section('content')
<div class="w-full max-w-screen-xl container-fuild mx-auto my-auto">
    <div class="flex justify-center items-center py-10 p-6">
      <div class="bg-white w-full max-w-md rounded-xl shadow-2xl pt-5 pb-3">
        <div class="mb-1 text-center border-b-2 border-gray-200 shadow-sm pb-2">
          <p class="font-bold text-orange-400 text-2xl mb-2">Đăng Nhập </p>
          <div class="flex justify-center items-center">
            <a class="flex justify-center items-center" href="">
              <img src="{{ asset('images/logo/logo.png') }}" alt="icon" style="width: 100px;">
            </a>
          </div>
        </div>
        <div class="px-9 mt-3">
          <form action="{{ route('login.post') }}" method="post">
            @csrf
            <input type="hidden" name="csrf_token" value="">
            <div class="py-1 mb-5">
              <label class="block">
                <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-500 ms-2">
                  Email
                </span>
                <input
                  type="email"
                  name="email"
                  class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
                  placeholder="nguyenvana@gmail.com" 
                  value="{{ old('email')}}"/>
                  @if ($errors->has('email'))
                      <span class="text-sm text-red-700 ps-4 mt-1">{{ $errors->first('email') }}</span>
                  @endif
              </label>
            </div>
            <!-- Trường mật khẩu -->
            <div>
                <label class="block">
                <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-500 ms-2">
                    Mật khẩu
                </span>
                <div class="relative">
                    <input
                    type="password"
                    id="password"
                    name="password"
                    class="mt-1 px-3 py-2 pr-10 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"
                    placeholder="NQH@123"
                     />
                    <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500" onclick="togglePassword('password', this)">
                    <i class="fa-regular fa-eye"></i>
                    </span>
                </div>
                @if ($errors->has('password'))
                        <span class="text-sm text-red-700 ps-4 mt-1">{{ $errors->first('password') }}</span>
                    @endif
                </label>
                <div class="flex justify-end my-2 pb-4">
                    <span class="text-sm text-gray-400"><a href="#">Quên mật khẩu</a></span>
                </div>
            </div>
  
            <div class="bg-purple-500 p-2 text-center rounded-full">
              <button type="submit" class="uppercase font-bold text-white w-full">Đăng nhập</button>
            </div>
            @if (session('error'))
                <div class="mt-3 text-red-500 text-sm text-center">
                    {{ session('error') }}
                </div>
            @endif
          </form>
        </div>
        <div class="flex justify-center mt-3">
          <span class="text-sm text-gray-400">Bạn chưa có tài khoản? <a href="{{ route('signup') }}" class="text-sky-500">Đăng ký ngay</a></span>
        </div>
        <div class="flex flex-col items-center mt-3 pb-3 justify-center">
          <span class="text-gray-400 text-sm">Hoặc, đăng nhập với</span>
          <div class="flex justify-center mt-3">
            <div class="flex items-center text-sm text-gray-500 mr-4 cursor-pointer p-2 hover:text-orange-400 ">
              <img src="https://res.cloudinary.com/whr-clound/image/upload/v1745417547/ax1vudmlwi60dp4wqjaf.webp" alt="" style="width: 22px;height: 22px;">
              <span class="ms-2">Google</span>
            </div>
            <div class="flex items-center text-sm text-gray-500 mr-4 cursor-pointer p-2 hover:text-orange-400 ">
              <a href="" class="flex items-center">
                <img src="https://res.cloudinary.com/whr-clound/image/upload/v1745417547/js8t7yjmysggys22xrpg.png" alt="" style="width: 22px;height: 22px;">
                <span class="ms-2">Facebook</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
@endsection

@push('scripts')
<script>
    function togglePassword(inputId, iconElement) {
      const input = document.getElementById(inputId);
      const icon = iconElement.querySelector('i');
  
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }
</script>
@endpush