<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DanhMucDungCu;

class DanhMucDungCuController extends Controller
{
    public function danhMucDungCuList() {
        $dsdmdc = DanhMucDungCu::all();
        return view('admin.danhmucdungcu', compact('dsdmdc'));
    }
    public function addDanhMucDungCu(Request $request) {
        if ($request->has('themmoi')) {
            $data = $request->all();
            DanhMucDungCu::create($data);
        }
        return redirect()->route('admin.danhmucdungcu');
    }
    public function deleteDanhMucDungCu($id) {
        DanhMucDungCu::destroy($id);
        return redirect()->route('admin.danhmucdungcu');
    }
    public function editDanhMucDungCu($id) {
        $dmdcct = DanhMucDungCu::findOrFail($id);
        $dsdmdc = DanhMucDungCu::all();
        return view('admin.updatedanhmucdungcu', compact('dmdcct', 'dsdmdc'));
    }
    public function updateDanhMucDungCu(Request $request, $id) {
        $dmdc = DanhMucDungCu::findOrFail($id);
        $data = $request->all();
        $dmdc->update($data);
        return redirect()->route('admin.danhmucdungcu');
    }
}
