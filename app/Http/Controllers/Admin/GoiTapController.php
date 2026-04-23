<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoiTap;

class GoiTapController extends Controller
{
    // Methods used by routes (match naming style of other controllers)
    public function goiTapList()
    {
        $dsgoitap = GoiTap::getAllGoiTap();
        return view('admin.goitap', compact('dsgoitap'));
    }

    public function addGoiTap(Request $request)
    {
        if ($request->has('themmoigoitap')) {
            $data = $request->all();
            GoiTap::createGoiTap($data);
        }
        return redirect()->route('admin.goitap');
    }

    public function deleteGoiTap($id)
    {
        GoiTap::deleteGoiTap($id);
        return redirect()->route('admin.goitap');
    }

    public function updateGoiTap(Request $request, $id)
    {
        $data = $request->all();
        GoiTap::updateGoiTapById($id, $data);
        return redirect()->route('admin.goitap');
    }

    public function toggleState($id)
    {
        $gt = GoiTap::getGoiTapById($id);
        $newState = ($gt->status ?? 'inactive') === 'active' ? 'inactive' : 'active';
        $gt->update(['status' => $newState ? 'active' : 'inactive']);
        return redirect()->route('admin.goitap');
    }

    /**
     * Hiển thị trang thống kê gói tập đã thanh toán (state = 1)
     */
    public function thongKeGoiTap()
    {
        $dsgoitap = GoiTap::query()
            ->where('status', 'active')
            ->get();

        $tongtien = $dsgoitap->sum(function ($goiTap) {
            $gia = (int) ($goiTap->gia ?? 0);
            $soLuong = (int) ($goiTap->soluong ?? 1);
            return $gia * $soLuong;
        });

        return view('admin.thongke', compact('dsgoitap', 'tongtien'));
    }
}
