<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
    
{
    public function showLoginForm()
    {
        return view('signin_signup.signin');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flush(); // Xóa tất cả session
        return redirect('/'); // Chuyển về trang index
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ], [
            'username.required' => 'Yêu cầu nhập tài khoản',
            'password.required' => 'Yêu cầu nhập mật khẩu',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();

            // Lấy user vừa đăng nhập
            $user = Auth::user();
            
            // Lưu thông tin vào session
            

            // Kiểm tra role và redirect
            if ($user->role_id == 1) {
                return redirect()->route('admin.trangchu');
            } elseif ($user->role_id == 3) {
                session([
                'user_id' => $user->id,
                'username' => $user->username,
                'role_id' => $user->role_id,
            ]);
                return redirect()->route('user.home');
            } else {
                Auth::logout();
                return back()->withErrors(['username' => 'Tài khoản không hợp lệ!'])->withInput();
            }
        }

        // Nếu đăng nhập thất bại, trả về lỗi
        return back()->withErrors([
            'username' => 'Tài khoản hoặc mật khẩu không đúng.',
        ])->withInput();
    }

    
}