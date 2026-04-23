<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LichTap;
use App\Models\TrainingCategory;

class LichTapController extends Controller
{
    public function lichTapList() {
        $dslt = LichTap::getAllLichTap();
        $categories = TrainingCategory::all(); // Lấy danh sách danh mục
        return view('admin.lichtap', compact('dslt', 'categories'));
    }
    public function addLichTap(Request $request) {
        $request->validate([
            'training_category_id' => 'required|exists:training_categories,id',
            'schedule_name' => 'required|string|max:100',
            'start_time' => 'required',
            'end_time' => 'required',
            'day_of_week' => 'required',
            'room' => 'required|string|max:100',
        ]);

        if ($request->has('themmoilichtap')) {
            $data = $request->all();
            LichTap::createLichTap($data);
        }
        return redirect()->route('admin.lichtap')->with('success', 'Thêm lịch tập thành công!');
    }
    public function deleteLichTap($id) {
        LichTap::deleteLichTap($id);
        return redirect()->route('admin.lichtap');
    }
    
    public function updateLichTap(Request $request, $id) {
        // dd($request->all());
        // $request->validate([
        //     'training_category_id' => 'required',
        //     'schedule_name' => 'required|string|max:100',
        //     'start_time' => 'required',
        //     'end_time' => 'required',
        //     'day_of_week' => 'required',
        //     'room' => 'required|string|max:100',
        // ]);

        $data = $request->all();
        
        $data['training_category_id'] = (int)$data['training_category_id'];

        
        $mapped = LichTap::translateFromLegacy($data);
        // dd($mapped);
        LichTap::updateLichTapById($id, $mapped);
        return redirect()->route('admin.lichtap')->with('success', 'Cập nhật lịch tập thành công!');
    }
}
