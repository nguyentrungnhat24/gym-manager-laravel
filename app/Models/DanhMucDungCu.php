<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhMucDungCu extends Model
{
    protected $table = 'equipment_categories';
    protected $fillable = [
        'category_name',
        'deleted',
    ];
    public $timestamps = false;

    // Legacy accessors/mutators for existing blades
    public function getTendmdcAttribute()
    {
        return $this->attributes['category_name'] ?? null;
    }

    public function setTendmdcAttribute($value)
    {
        $this->attributes['category_name'] = $value;
    }
}