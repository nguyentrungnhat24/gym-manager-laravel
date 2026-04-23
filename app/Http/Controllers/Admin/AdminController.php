<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoiTap;
use App\Models\LichTap;
use App\Models\DungCu;
use App\Models\PT;
use App\Models\KhachHang;
use App\Models\NhanVien;

class AdminController extends Controller
{
    public function index()
    {
        // Thống kê tổng quan
        $totalGoiTap = GoiTap::count();
        $totalLichTap = LichTap::count();
        $totalDungCu = DungCu::count();
        $totalPT = PT::count();
      
        $totalNhanVien = NhanVien::count();
        
        return view('admin.trangchu', compact(
            'totalGoiTap',
            'totalLichTap', 
            'totalDungCu',
            'totalPT',
            'totalNhanVien'
        ));
    }

    public function trangchu()
    {
        return $this->index();
    }

    public function dashboard()
    {
        return $this->index();
    }
}
