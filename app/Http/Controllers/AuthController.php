<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function login()
    {
        return view('customer.auth.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'email.email' => 'Email không hợp lệ!',
            'password.required' => 'Vui lòng nhập đầy đủ thông tin!',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'customer') {
                return redirect()->route('home');
            } else {
                return back()->with('error', 'Thông tin đăng nhập không đúng!');
            }
        }

        return back()->with('error', 'Thông tin đăng nhập không đúng!')->withInput();
    }
    public function signup()
    {
        return view('customer.auth.signup');
    }

    public function signupPost(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'cfpassword' => 'required|same:password',
        ], [
            'username.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'email.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'email.email' => 'Email không hợp lệ!',
            'password.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự!',
            'cfpassword.required' => 'Vui lòng nhập đầy đủ thông tin!',
            'cfpassword.same' => 'Mật khẩu không khớp!',
        ]);

        try {
            $user = new User();
            $user->name = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'customer';
            $user->save();

            return redirect()->route('login')->with('success', 'Đăng ký thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Đăng ký thất bại.')->withInput();
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
