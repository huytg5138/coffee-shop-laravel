<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Hiện trang đăng nhập
    public function showLogin() {
        if (Auth::check()) return redirect()->route('dashboard'); // Nếu login rồi thì vào thẳng trong
        return view('auth.login');
    }

    // 2. Xử lý khi nhấn nút Đăng nhập
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/'); // Đưa người dùng về trang họ định vào
        }

        return back()->with('error', 'Email hoặc mật khẩu không đúng!');
    }

    // 3. Đăng xuất
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}