<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoiTap extends Model
{
    protected $table = 'training_packages';
    protected $fillable = [
        'training_name',
        'price',
        'quantity',
        'duration_days',
        'category_id',
        'user_id',
        'customer_name',
        'customer_address',
        'customer_phone',
        'customer_email',
        'start_date',
        'end_date',
        'status',
        'deleted',
    ];
    public $timestamps = false;

    // Legacy accessors
    public function getTenloptapAttribute() { return $this->attributes['training_name'] ?? null; }
    public function getGiaAttribute() { return $this->attributes['price'] ?? null; }
    public function getSoluongAttribute() { return $this->attributes['quantity'] ?? null; }
    public function getThoigianAttribute() { return $this->attributes['duration_days'] ?? null; }
    public function getTenkhAttribute() { return $this->attributes['customer_name'] ?? null; }
    public function getDiachiAttribute() { return $this->attributes['customer_address'] ?? null; }
    public function getSdtAttribute() { return $this->attributes['customer_phone'] ?? null; }
    public function getEmailAttribute() { return $this->attributes['customer_email'] ?? null; }
    public function getStateAttribute() { return ($this->attributes['status'] ?? 'inactive') === 'active' ? 1 : 0; }

    protected static function translateFromLegacy(array $data): array
    {
        $mapped = $data;
        if (isset($data['tenloptap'])) $mapped['training_name'] = $data['tenloptap'];
        if (isset($data['gia'])) $mapped['price'] = $data['gia'];
        if (isset($data['soluong'])) $mapped['quantity'] = $data['soluong'];
        if (isset($data['thoigian'])) $mapped['duration_days'] = $data['thoigian'];
        if (isset($data['iddmlt'])) $mapped['category_id'] = $data['iddmlt'];
        if (isset($data['idkh'])) $mapped['user_id'] = $data['idkh'];
        if (isset($data['tenkh'])) $mapped['customer_name'] = $data['tenkh'];
        if (isset($data['diachi'])) $mapped['customer_address'] = $data['diachi'];
        if (isset($data['sdt'])) $mapped['customer_phone'] = $data['sdt'];
        if (isset($data['email'])) $mapped['customer_email'] = $data['email'];
        if (isset($data['dangki'])) $mapped['start_date'] = $data['dangki'];
        if (isset($data['thoihan'])) $mapped['end_date'] = $data['thoihan'];
        return $mapped;
    }

    public static function getAllGoiTap()
    {
        return self::all();
    }

    public static function createGoiTap($data)
    {
        return self::create(self::translateFromLegacy($data));
    }

    public static function deleteGoiTap($id)
    {
        return self::destroy($id);
    }

    public static function getGoiTapById($id)
    {
        return self::findOrFail($id);
    }

    public static function updateGoiTapById($id, $data)
    {
        $gt = self::findOrFail($id);
        return $gt->update(self::translateFromLegacy($data));
    }
}