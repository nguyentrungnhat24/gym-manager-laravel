<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PT;
use App\Models\TrainingCategory;
use Illuminate\Support\Facades\Validator;

class PTController extends Controller
{
    /**
     * Hiển thị danh sách PT và danh mục
     */
    public function ptList() {
        $dspt = PT::getAllPT(); // Lấy danh sách PT
        $categories = TrainingCategory::all(); // Lấy danh sách danh mục
       
        return view('admin.pt', compact('dspt', 'categories')); // Truyền danh mục vào view
    }
    
    /**
     * Thêm PT mới
     */
    public function addPT(Request $request) {
        $request->validate([
            'full_name' => 'required|string|max:100',
            'phone_number' => 'required|digits_between:9,11',
            'email' => 'required|email|unique:trainers,email',
            'position' => 'nullable|string|max:50',
            'philosophy' => 'nullable|string|max:255',
            'training_category_id' => 'required|exists:training_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->has('themmoi')) {
            PT::createPT($request);
        }

        

        return redirect()->route('admin.pt')->with('success', 'Thêm PT thành công!');
    }
    
    /**
     * Xóa PT
     */
    public function deletePT($id) {
        PT::deletePTById($id);
        return redirect()->route('admin.pt')->with('success', 'Xóa PT thành công!');
    }
    
    /**
     * Hiển thị thông tin PT để chỉnh sửa
     */
    public function editPT($id) {
        $ptct = PT::getPTById($id);
        $dspt = PT::getAllPT();
        $categories = TrainingCategory::getAllCategories(); // Lấy danh sách danh mục
        return view('admin.updatept', compact('ptct', 'dspt', 'categories'));
    }
    
    /**
     * Cập nhật thông tin PT
     */
    public function updatePT(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:100',
            'phone_number' => 'required|digits_between:9,11',
            'email' => 'required|email|unique:trainers,email,' . $id,
            'position' => 'nullable|string|max:50',
            'philosophy' => 'nullable|string|max:255',
            'training_category_id' => 'required|exists:training_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('pt_update_id', $id)
                ->with('pt_update_error', true);
        }

        PT::updatePTById($request, $id);
        return redirect()->route('admin.pt')->with('success', 'Cập nhật PT thành công!');
    }

    /**
     * Xuất danh sách PT
     */
    public function exportPT() {
        return PT::exportPT();
    }

    /**
     * Hiển thị danh sách PT theo danh mục
     */
    public function ptByCategory() {
        $categories = TrainingCategory::with('pts')->get(); // Lấy tất cả danh mục và PT liên quan
        return view('admin.pt_by_category', compact('categories'));
    }
}
