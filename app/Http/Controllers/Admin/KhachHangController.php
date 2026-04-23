<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class KhachHangController extends Controller
{
    public function khachHangList() {
        $dskh = User::getAllUsers('role_id', 3);
        return view('admin.khachhang', compact('dskh'));
    }
    public function addKhachHang(Request $request) {
        if ($request->has('addKhachHang')) {
            $data = $request->only(['full_name', 'phone_number', 'email', 'address', 'username', 'password']);

            $validator = Validator::make($data, User::$rules);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image');
            }
            if (!empty($data['password'])) {
                $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
                unset($data['password']);
            }

            $data['role_id'] = 3; // Khách hàng
            
            User::createUser($data);
        }
        return redirect()->route('admin.khachhang');
    }
    public function deleteKhachHang($id) {
        User::deleteUser($id);
        return redirect()->route('admin.khachhang');
    }
    public function editKhachHang($id) {
        $khct = User::getUserById($id);
        $dskh = User::getAllUsers();
        return view('admin.updatekh', compact('khct', 'dskh'));
    }
    public function updateKhachHang(Request $request, $id) {
        $data = $request->only([
            'full_name', 'phone_number', 'email', 'address', 'username', 'password'
        ]);

        // Lấy user hiện tại
        $user = User::findOrFail($id);

        // Rules cho update
        $rules = [
            'full_name' => 'required|string|max:100',
            'phone_number' => 'required|digits_between:9,11',
            'email' => 'required|email|max:100|unique:users,email,' . $user->id,
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:5',
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image');
        }
        if (!empty($data['password'])) {
            $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
            unset($data['password']);
        }
        User::updateUser($id, $data);
        return redirect()->route('admin.khachhang');
    }
}
