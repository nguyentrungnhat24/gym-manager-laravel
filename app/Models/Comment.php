<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    
    protected $fillable = [
        'user_id',
        'schedule_id', 
        'title',
        'comment_text',
        'deleted'
    ];

    public $timestamps = false;

    /**
     * Người dùng đã bình luận
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Lịch tập mà bình luận thuộc về
     */
    public function schedule()
    {
        return $this->belongsTo(LichTap::class, 'schedule_id');
    }

    /**
     * Lấy bình luận theo lớp tập
     */
    public static function getCommentsByLopTap($idlt)
    {
        return self::where('idlt', $idlt)
                   ->orderBy('id', 'desc')
                   ->get();
    }

    /**
     * Tạo bình luận mới
     */
    public static function createComment($data)
    {
        return self::create($data);
    }
}
