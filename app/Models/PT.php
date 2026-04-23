<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PT extends Model
{
    protected $table = 'trainers';
    protected $fillable = [
        'full_name',
        'phone_number',
        'email',
        'position',
        'philosophy',
        'training_category_id',
        'image_path',
    ];
    public $timestamps = false;

    /**
     * Lấy danh sách tất cả PT
     */
    public static function getAllPT()
    {
        return self::all();
    }

    /**
     * Tạo PT mới
     */
    public static function createPT(Request $request)
    {
        $data = self::translateFromLegacy($request->all());
        $data['training_category_id'] = $request->training_category_id; // Lưu danh mục

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('admin/uploaded', 'public');
            $data['image_path'] = 'storage/' . $path;
        }

        return self::create($data);
    }

    /**
     * Xóa PT theo ID
     */
    public static function deletePTById($id)
    {
        return self::destroy($id);
    }

    /**
     * Lấy PT theo ID
     */
    public static function getPTById($id)
    {
        return self::findOrFail($id);
    }

    /**
     * Cập nhật PT
     */
    public static function updatePTById(Request $request, $id)
    {
        $pt = self::findOrFail($id);
        $data = self::translateFromLegacy($request->all());
        $data['training_category_id'] = $request->training_category_id; // Cập nhật danh mục

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('admin/uploaded', 'public');
            $data['image_path'] = 'storage/' . $path;
        }
    
    
    $pt->update($data);
    }

    /**
     * Xuất dữ liệu PT ra file CSV
     */
    public static function exportPT()
    {
        $pts = self::getAllPT();
        
        $filename = 'danh_sach_pt_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($pts) {
            $file = fopen('php://output', 'w');
            
            // UTF-8 BOM để Excel hiển thị tiếng Việt đúng
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($file, [
                'ID',
                'Tên PT',
                'Số điện thoại', 
                'Email',
                'Vai trò',
                'Quan điểm',
                'Hình ảnh'
            ]);
            
            // Data
            foreach ($pts as $pt) {
                fputcsv($file, [
                    $pt->id,
                    $pt->full_name,
                    $pt->phone_number,
                    $pt->email,
                    $pt->position,
                    $pt->philosophy,
                    $pt->image_path
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    // ===== Legacy accessors to keep blades working =====
    public function getTenptAttribute() { return $this->attributes['full_name'] ?? null; }
    public function getImageAttribute() { return $this->attributes['image_path'] ?? null; }
    public function getSodtAttribute() { return $this->attributes['phone_number'] ?? null; }
    public function getVaitroAttribute() { return $this->attributes['position'] ?? null; }
    public function getQuandiemAttribute() { return $this->attributes['philosophy'] ?? null; }

    public static function translateFromLegacy(array $data): array
    {
        $mapped = $data;
        if (isset($data['tenpt'])) $mapped['full_name'] = $data['tenpt'];
        if (isset($data['sodt'])) $mapped['phone_number'] = $data['sodt'];
        if (isset($data['vaitro'])) $mapped['position'] = $data['vaitro'];
        if (isset($data['quandiem'])) $mapped['philosophy'] = $data['quandiem'];
        // Các trường khác giữ nguyên
        return $mapped;
    }

    public function trainingCategory()
    {
        return $this->belongsTo(TrainingCategory::class, 'training_category_id');
    }

    public function scopeByTrainingCategory($query, $categoryId)
    {
        return $query->where('training_category_id', $categoryId);
    }
}