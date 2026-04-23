<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LichTap extends Model
{
    public function getPhongtapAttribute() {
        return $this->attributes['room'] ?? null;
    }
    protected $table = 'training_schedules';
    protected $fillable = [
        'id',
        'schedule_name',
        'start_time',
        'end_time',
        'day_of_week',
        'room',
        'training_category_id',
        'deleted',
    ];
    public $timestamps = false;

    // Quan hệ nhiều-1 với bảng training_categories
    public function trainingCategory()
    {
        return $this->belongsTo(TrainingCategory::class, 'training_category_id');
    }

    // Legacy accessors/mutators mapping
    public function getTenAttribute() { return $this->attributes['schedule_name'] ?? null; }
    public function setTenAttribute($v) { $this->attributes['schedule_name'] = $v; }
    public function getBatDauAttribute() { return $this->attributes['start_time'] ?? null; }
    public function setBatDauAttribute($v) { $this->attributes['start_time'] = $v; }
    public function getKetThucAttribute() { return $this->attributes['end_time'] ?? null; }
    public function setKetThucAttribute($v) { $this->attributes['end_time'] = $v; }
    public function getNgayTapAttribute() {
        $english = $this->attributes['day_of_week'] ?? null;
        $map = [
            'Monday' => 'Thứ 2',
            'Tuesday' => 'Thứ 3',
            'Wednesday' => 'Thứ 4',
            'Thursday' => 'Thứ 5',
            'Friday' => 'Thứ 6',
            'Saturday' => 'Thứ 7',
            'Sunday' => 'Chủ nhật',
        ];
        return $map[$english] ?? $english;
    }
    public function setNgayTapAttribute($v) {
        $map = [
            'Thứ 2' => 'Monday',
            'Thứ 3' => 'Tuesday',
            'Thứ 4' => 'Wednesday',
            'Thứ 5' => 'Thursday',
            'Thứ 6' => 'Friday',
            'Thứ 7' => 'Saturday',
            'Chủ nhật' => 'Sunday',
        ];
        $this->attributes['day_of_week'] = $map[$v] ?? $v;
    }
    public function setPhongtapAttribute($v) { $this->attributes['room'] = $v; }
    public function getIdloptapAttribute() { return $this->attributes['training_category_id'] ?? null; }
    public function setIdloptapAttribute($v) { $this->attributes['training_category_id'] = $v; }

    protected static function translateFromLegacy(array $data): array
    {
        $mapped = $data;
        if (isset($data['Ten'])) $mapped['schedule_name'] = $data['Ten'];
        if (isset($data['BatDau'])) $mapped['start_time'] = $data['BatDau'];
        if (isset($data['KetThuc'])) $mapped['end_time'] = $data['KetThuc'];
        if (isset($data['NgayTap'])) {
            $vn = $data['NgayTap'];
            $map = [
                'Thứ 2' => 'Monday',
                'Thứ 3' => 'Tuesday',
                'Thứ 4' => 'Wednesday',
                'Thứ 5' => 'Thursday',
                'Thứ 6' => 'Friday',
                'Thứ 7' => 'Saturday',
                'Chủ nhật' => 'Sunday',
            ];
            $mapped['day_of_week'] = $map[$vn] ?? $vn;
        }
        if (isset($data['phongtap'])) $mapped['room'] = $data['phongtap'];
        if (isset($data['training_category_id'])) $mapped['training_category_id'] = $data['training_category_id'];
        return $mapped;
    }

    public static function getAllLichTap()
    {
        return self::all();
    }

    public static function createLichTap($data)
    {
        return self::create(self::translateFromLegacy($data));
    }

    public static function deleteLichTap($id)
    {
        return self::destroy($id);
    }

    public static function getLichTapById($id)
    {
        return self::findOrFail($id);
    }

    public static function updateLichTapById($id, $data)
{
    $lt = self::findOrFail($id);
    $lt->update($data);
}
}