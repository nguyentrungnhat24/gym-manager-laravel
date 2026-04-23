<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'username',
        'password_hash',
        'full_name',
        'image_path',
        'address',
        'phone_number',
        'email',
        'role_id',
        'deleted',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

     // Nếu bạn muốn Laravel dùng cột 'user' để đăng nhập
    public function getAuthIdentifierName()
    {
        return 'username';
    }

    // Mutator để hash password khi lưu vào database
    public function setPasswordAttribute($value)
    {
        $this->attributes['password_hash'] = bcrypt($value);
    }

    // Accessor để lấy password field cho authentication
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Lấy tất cả user
    public static function getAllUsers($field = null, $value = null) { 
        if ($field && $value !== null) {
            return self::where($field, $value)->get();
        }
        return self::all(); 
    }

    // Tạo user mới, xử lý upload ảnh nếu có
    public static function createUser($data)
    {
        if (isset($data['image'])) {
            $data['image_path'] = self::handleImageUpload($data['image']);
            unset($data['image']);
        }
        

        // Không cần map lại nếu tên trường đã đúng
        if (empty($data['password'])) {
            unset($data['password']);
        }

        return self::create($data);
    }

    // Cập nhật user
    public static function updateUser($id, $data)
    {
        $user = self::findOrFail($id);
        if (isset($data['image'])) {
            $data['image_path'] = self::handleImageUpload($data['image']);
        }
        if (!empty($data['password'])) {
            $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
       
        unset($data['password'], $data['image']);
        $user->update($data);
        return $user;
    }

    // Xóa user
    public static function deleteUser($id) {
        return self::destroy($id);
    }

    // Lấy user theo id
    public static function getUserById($id) {
        return self::findOrFail($id);
    }

    // ===== Legacy accessors to keep blades working (if any reference old names) =====
    public function getUserAttribute() { return $this->attributes['username'] ?? null; }
    public function getNameeAttribute() { return $this->attributes['full_name'] ?? null; }
    public function getImageAttribute() { return $this->attributes['image_path'] ?? null; }
    public function getAddresssAttribute() { return $this->attributes['address'] ?? null; }
    public function getRoleAttribute() { return $this->attributes['role_id'] ?? null; }

    protected static function translateFromLegacy(array $data): array
    {
        $mapped = $data;
        if (isset($data['user'])) $mapped['username'] = $data['user'];
        if (isset($data['namee'])) $mapped['full_name'] = $data['namee'];
        if (isset($data['image'])) $mapped['image_path'] = $data['image'];
        if (isset($data['addresss'])) $mapped['address'] = $data['addresss'];
        if (isset($data['role'])) $mapped['role_id'] = $data['role'];
        if (isset($data['password'])) $mapped['password_hash'] = bcrypt($data['password']);
        return $mapped;
    }

    public static function handleImageUpload($file)
    {
        if (!$file) return null;
        $filename =   $file->getClientOriginalName();
        $path = 'uploaded/' . $filename;
        $file->move(public_path('uploaded'), $filename);
        return $path;
    }

    public static $rules = [
        'tennv'   => 'required|string|max:100',
        'sodt'    => 'required|digits_between:9,11',
        'email'   => 'required|email|max:100|unique:users,email',
        'diachi'  => 'required|string|max:255',
        'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'username'=> 'required|string|max:50|unique:users,username',
        'password'=> 'required|string|min:5',
    ];
}
