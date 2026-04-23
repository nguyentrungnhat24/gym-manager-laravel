<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'username', 'password_hash', 'full_name', 'image_path', 'address', 'phone_number', 'email', 'role_id', 'deleted'
    ];
    public $timestamps = false;

    // Scope lấy danh sách nhân viên (role_id = 2)
    public function scopeNhanVien($query)
    {
        return $query->where('role_id', 2);
    }

    // Xử lý upload ảnh
    public static function handleImageUpload($request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $originalName = $file->getClientOriginalName();

            // Tạo thư mục nếu chưa tồn tại
            $uploadPath = public_path('uploaded');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Lưu file trực tiếp vào public/admin/uploaded
            $file->move($uploadPath, $originalName);
            return 'uploaded/' . $originalName;
        }
        return 'uploaded/avatar.png';
    }

    // Xử lý upload ảnh cho update (giữ tên gốc, cho phép ghi đè)
    public function handleImageUploadForUpdate($request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $originalName = $file->getClientOriginalName();

            // Tạo thư mục nếu chưa tồn tại
            $uploadPath = public_path('uploaded');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Lưu file trực tiếp vào public/admin/uploaded
            $file->move($uploadPath, $originalName);
            return 'uploaded/' . $originalName;
        }
        return null; // Không thay đổi ảnh
    }
    

    // Tạo nhân viên mới với logic business
    public static function createNhanVien($request)
    {
        $data = $request->only(['tennv', 'sodt', 'email', 'diachi', 'username', 'password']);
        $data['image_path'] = self::handleImageUpload($request);

        $data = self::translateFromLegacy($data);
        $data['role_id'] = 2;

        $data['full_name'] = $data['tennv'];
        $data['phone_number'] = $data['sodt'];
        $data['address'] = $data['diachi'];

        // Hash password
        if (!empty($data['password'])) {
            $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
            unset($data['password']);
        }

        return self::create($data);
    }

    // Cập nhật nhân viên với logic business
    public function updateNhanVien($request)
    {
        $data = $request->only(['tennv', 'sodt', 'email', 'diachi', 'username', 'password']);
        $newImagePath = $this->handleImageUploadForUpdate($request);
        if ($newImagePath) {
            $data['image_path'] = $newImagePath;
        }
        $data['full_name'] = $data['tennv'];
        $data['phone_number'] = $data['sodt'];
        $data['address'] = $data['diachi'];

        // Nếu có nhập password mới thì hash lại
        if (!empty($data['password'])) {
            $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        unset($data['tennv'], $data['sodt'], $data['diachi'], $data['password']);

        return $this->update($data);
    }

    // Scope để lọc theo vai trò
    public function scopeByVaiTro($query, $vaitro)
    {
        return $query->where('vaitro', $vaitro);
    }

    // Accessor để format số điện thoại
    public function getFormattedPhoneAttribute()
    {
        return preg_replace('/(\d{4})(\d{3})(\d{3})/', '$1 $2 $3', $this->phone_number);
    }

    // Mutator để format email
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower(trim($value));
    }

    // ===== Legacy accessors to keep blades working =====
    public function getTennvAttribute() { return $this->attributes['full_name'] ?? null; }
    public function getImageAttribute() { return $this->attributes['image_path'] ?? null; }
    public function getSodtAttribute() { return $this->attributes['phone_number'] ?? null; }
    public function getDiachiAttribute() { return $this->attributes['address'] ?? null; }
    

    protected static function translateFromLegacy(array $data): array
    {
        $mapped = $data;
        if (isset($data['tennv'])) $mapped['full_name'] = $data['tennv'];
        if (isset($data['sodt'])) $mapped['phone_number'] = $data['sodt'];
        if (isset($data['diachi'])) $mapped['address'] = $data['diachi'];

        if (isset($data['image'])) $mapped['image_path'] = $data['image'];
        return $mapped;
    }

    // Quy tắc validate dùng cho controller
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

$nhanViens = NhanVien::nhanVien()->get();