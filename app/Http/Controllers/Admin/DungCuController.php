<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DungCu;
use App\Models\DanhMucDungCu;

class DungCuController extends Controller
{
    public function dungCuList() {
        // Lấy tất cả danh mục dụng cụ
        $danhMucDungCu = DanhMucDungCu::all();
        
        // Lấy dụng cụ theo từng danh mục
        $dungCuTheoDanhMuc = [];
        foreach ($danhMucDungCu as $danhMuc) {
            $dungCuTheoDanhMuc[$danhMuc->id] = [
                'danhMuc' => $danhMuc,
                'dungCu' => DungCu::getByCategory($danhMuc->id)
            ];
        }
        
        return view('admin.dungcu', compact('dungCuTheoDanhMuc', 'danhMucDungCu'));
    }
    
    public function addDungCu(Request $request) {
        if ($request->has('themmoi')) {
            $data = $request->all();
            
            // Xử lý upload ảnh
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('admin/uploaded'), $fileName);
                $data['image'] = '/admin/uploaded/' . $fileName;
            }
            
            DungCu::createDungCu($data);
        }
        return redirect()->route('admin.dungcu');
    }
    
    public function deleteDungCu($id) {
        DungCu::deleteDungCu($id);
        return redirect()->route('admin.dungcu');
    }
    
    public function editDungCu($id) {
        $dcct = DungCu::getDungCuById($id);
        $danhMucDungCu = DanhMucDungCu::all();
        return view('admin.updatedc', compact('dcct', 'danhMucDungCu'));
    }
    
    public function updateDungCu(Request $request, $id) {
        $data = $request->all();
        
        // Xử lý upload ảnh mới nếu có
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('admin/uploaded'), $fileName);
            $data['image'] = '/admin/uploaded/' . $fileName;
        }
        
        DungCu::updateDungCuById($id, $data);
        return redirect()->route('admin.dungcu');
    }
}
