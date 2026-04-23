<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('signin_signup.signup');
    }

    public function register(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
            'repassword' => 'required|same:password',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:users,email',
        ], [
            'name.required' => 'Yêu cầu nhập họ và tên',
            'username.required' => 'Yêu cầu nhập tài khoản',
            'username.unique' => 'Tài khoản đã tồn tại',
            'password.required' => 'Yêu cầu nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'repassword.required' => 'Yêu cầu nhập lại mật khẩu',
            'repassword.same' => 'Mật khẩu không trùng nhau',
            'address.required' => 'Yêu cầu nhập địa chỉ',
            'phone_number.required' => 'Yêu cầu nhập số điện thoại',
            'email.required' => 'Yêu cầu nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
        ]);

        try {
            // Tạo user mới
            $user = new User();
            $user->username = $request->username;
            $user->password = $request->password; // Sẽ được hash tự động bởi mutator
            $user->full_name = $request->name;
            $user->address = $request->address;
            $user->phone_number = $request->phone_number;
            $user->email = $request->email;
            $user->role_id = 3; // Role mặc định cho customer
            $user->save();

        

            return redirect()->back()->with('success', 'Đăng ký thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }

    
} 