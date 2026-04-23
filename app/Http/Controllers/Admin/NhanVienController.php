<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NhanVien;
use Illuminate\Support\Facades\Validator;

class NhanVienController extends Controller
{
    public function addNhanVien(Request $request)
    {
        if ($request->has('themmoi')) {

            $data = $request->only(['full_name', 'phone_number', 'email', 'address', 'username', 'password']);
            
            // Validation
            $validator = Validator::make($request->all(), NhanVien::$rules);
            
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if (!empty($data['password'])) {
                $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
                unset($data['password']);
            }

            $data['role_id'] =2; // Khách hàng
            
            // Sử dụng logic từ model
            NhanVien::createNhanVien($request);
        }
        return redirect()->route('admin.nhanvien');
    }

    public function updateNhanVien(Request $request, $id)
    {
        $nv = NhanVien::findOrFail($id);

        // Tùy chỉnh rules cho update: không bắt buộc đổi email, username, password nếu không thay đổi
        $rules = [
            'tennv'   => 'required|string|max:100',
            'sodt'    => 'required|digits_between:9,11',
            'email'   => 'required|email|max:100|unique:users,email,' . $nv->id,
            'diachi'  => 'required|string|max:255',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'username'=> 'required|string|max:50|unique:users,username,' . $nv->id,
            // Password chỉ required nếu nhập mới
            'password'=> 'nullable|string|min:5',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('nhanvien_update_id', $id)
                ->with('nhanvien_update_error', true);
        }

        // Sử dụng logic từ model
        $nv->updateNhanVien($request);
        return redirect()->route('admin.nhanvien');
    }

    public function deleteNhanVien($id)
    {
        NhanVien::destroy($id);
        return redirect()->route('admin.nhanvien');
    }

    public function nhanVienList()
    {
        $nhanviens = NhanVien::nhanvien()->get();
        return view('admin.nhanvien', compact('nhanviens'));
    }

    // Thêm method để lọc theo vai trò
    public function nhanVienByVaiTro($vaitro)
    {
        $nhanviens = NhanVien::byVaiTro($vaitro)->get();
        return view('admin.nhanvien', compact('nhanviens'));
    }
}
