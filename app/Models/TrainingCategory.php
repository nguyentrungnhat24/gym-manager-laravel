<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingCategory extends Model
{
    protected $table = 'training_categories';

    protected $fillable = [
        'category_name',
        'price',
        'duration_days',
        'deleted',
    ];

    // Quan hệ 1-nhiều với bảng training_schedules
    public function lichTaps()
    {
        return $this->hasMany(LichTap::class, 'training_category_id');
    }
    
    public function pts()
    {
        return $this->hasMany(PT::class, 'training_category_id');
    }
}