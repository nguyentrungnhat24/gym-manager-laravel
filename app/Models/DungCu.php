<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DungCu extends Model
{
    protected $table = 'equipments';
    protected $fillable = [
        'equipment_name',
        'image_path',
        'price',
        'condition_status',
        'quantity',
        'category_id',
        'deleted',
    ];
    public $timestamps = false;

    // ===== Legacy attribute accessors for existing blades/controllers =====
    public function getTendcAttribute()
    {
        return $this->attributes['equipment_name'] ?? null;
    }

    public function getImageAttribute()
    {
        return $this->attributes['image_path'] ?? null;
    }

    public function getGiaAttribute()
    {
        return $this->attributes['price'] ?? null;
    }

    public function getTinhtrangAttribute()
    {
        $raw = $this->attributes['condition_status'] ?? null;
        if ($raw === 'New') return 'Mới';
        if ($raw === 'Used') return 'Đã qua sử dụng';
        return $raw;
    }

    public function getSoluongAttribute()
    {
        return $this->attributes['quantity'] ?? null;
    }

    public function getIddmdcAttribute()
    {
        return $this->attributes['category_id'] ?? null;
    }

    // ===== Legacy mutators to accept old request keys =====
    public function setTendcAttribute($value)
    {
        $this->attributes['equipment_name'] = $value;
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image_path'] = $value;
    }

    public function setGiaAttribute($value)
    {
        $this->attributes['price'] = $value;
    }

    public function setTinhtrangAttribute($value)
    {
        // Map Vietnamese legacy values to new enum values
        $mapped = $value;
        if (in_array($value, ['Mới', 'Moi', 'New'])) {
            $mapped = 'New';
        } else {
            $mapped = 'Used';
        }
        $this->attributes['condition_status'] = $mapped;
    }

    public function setSoluongAttribute($value)
    {
        $this->attributes['quantity'] = $value;
    }

    public function setIddmdcAttribute($value)
    {
        $this->attributes['category_id'] = $value;
    }

    // ===== Helpers (preserve existing API but translate keys) =====
    public static function getAllDungCu()
    {
        return self::all();
    }

    protected static function translateFromLegacy(array $data): array
    {
        $mapped = $data;
        if (isset($data['tendc'])) $mapped['equipment_name'] = $data['tendc'];
        if (isset($data['image'])) $mapped['image_path'] = $data['image'];
        if (isset($data['gia'])) $mapped['price'] = $data['gia'];
        if (isset($data['tinhtrang'])) {
            $mapped['condition_status'] = in_array($data['tinhtrang'], ['Mới', 'Moi', 'New']) ? 'New' : 'Used';
        }
        if (isset($data['soluong'])) $mapped['quantity'] = $data['soluong'];
        if (isset($data['iddmdc'])) $mapped['category_id'] = $data['iddmdc'];
        return $mapped;
    }

    public static function createDungCu(array $data)
    {
        return self::create(self::translateFromLegacy($data));
    }

    public static function deleteDungCu(int $id)
    {
        return self::destroy($id);
    }

    public static function getDungCuById(int $id)
    {
        return self::findOrFail($id);
    }

    public static function updateDungCuById(int $id, array $data)
    {
        $dc = self::findOrFail($id);
        return $dc->update(self::translateFromLegacy($data));
    }

    public static function getByCategory(int $categoryId)
    {
        return self::where('category_id', $categoryId)->get();
    }
}