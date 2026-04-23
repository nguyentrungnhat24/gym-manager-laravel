<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NhanVienController;
use App\Http\Controllers\Admin\PTController;
use App\Http\Controllers\Admin\GoiTapController;
use App\Http\Controllers\Admin\LichTapController;
use App\Http\Controllers\Admin\DungCuController;
use App\Http\Controllers\Admin\DanhMucDungCuController;
use App\Http\Controllers\Admin\KhachHangController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ClassController;
use App\Http\Controllers\User\ScheduleController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\TrainerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

// Các route cơ bản cho user (không cần prefix)
// Route::get('/home', [UserController::class, 'home'])->name('home');
// Route::get('/classes', [ClassController::class, 'index'])->name('classes');
// Route::get('/class/{id}', [ClassController::class, 'show'])->name('class.detail');
// Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
// Route::get('/contact', [UserController::class, 'contact'])->name('contact');
// Route::get('/trainer', [TrainerController::class, 'index'])->name('trainer');
// Route::get('/service', [UserController::class, 'service'])->name('service');
// Route::get('/bmi', [UserController::class, 'bmi'])->name('bmi');

Route::get('admin/app', function () {
    return view('admin.layouts.app');
});

    
// Login routes
Route::get('/signin', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('signin');
Route::post('/signin', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('check_login');

    
// Register routes
Route::get('/signup', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('signup');
Route::post('/signup', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');

// Logout route
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/trangchu', [AdminController::class, 'index'])->name('trangchu');

    

    // NhanVien routes
    Route::get('/nhanvien', [NhanVienController::class, 'nhanVienList'])->name('nhanvien');
    Route::post('/nhanvien/add', [NhanVienController::class, 'addNhanVien'])->name('nhanvien.add');
    Route::get('/nhanvien/edit/{id}', [NhanVienController::class, 'editNhanVien'])->name('nhanvien.edit');
    Route::put('/nhanvien/update/{id}', [NhanVienController::class, 'updateNhanVien'])->name('nhanvien.update');
    Route::get('/nhanvien/delete/{id}', [NhanVienController::class, 'deleteNhanVien'])->name('nhanvien.delete');

    // KhachHang routes
    Route::get('/khachhang', [KhachHangController::class, 'khachHangList'])->name('khachhang');
    Route::post('/khachhang/add', [KhachHangController::class, 'addKhachHang'])->name('khachhang.add');
    Route::get('/khachhang/edit/{id}', [KhachHangController::class, 'editKhachHang'])->name('khachhang.edit');
    Route::post('/khachhang/update/{id}', [KhachHangController::class, 'updateKhachHang'])->name('khachhang.update');
    Route::get('/khachhang/delete/{id}', [KhachHangController::class, 'deleteKhachHang'])->name('khachhang.delete');

    // PT routes
    Route::get('/pt', [PTController::class, 'ptList'])->name('pt');
    Route::post('/pt/add', [PTController::class, 'addPT'])->name('pt.add');
    Route::get('/pt/edit/{id}', [PTController::class, 'editPT'])->name('pt.edit');
    Route::put('/pt/update/{id}', [PTController::class, 'updatePT'])->name('pt.update');
    Route::get('/pt/delete/{id}', [PTController::class, 'deletePT'])->name('pt.delete');
    Route::get('/pt/export', [PTController::class, 'exportPT'])->name('pt.export');
    Route::get('/pt-by-category', [PTController::class, 'ptByCategory'])->name('admin.pt.by_category');

    // GoiTap routes
    Route::get('/goitap', [GoiTapController::class, 'goiTapList'])->name('goitap');
    Route::post('/goitap/add', [GoiTapController::class, 'addGoiTap'])->name('goitap.add');
    Route::get('/goitap/edit/{id}', [GoiTapController::class, 'editGoiTap'])->name('goitap.edit');
    Route::post('/goitap/update/{id}', [GoiTapController::class, 'updateGoiTap'])->name('goitap.update');
    Route::get('/goitap/delete/{id}', [GoiTapController::class, 'deleteGoiTap'])->name('goitap.delete');
    Route::get('/goitap/toggle/{id}', [GoiTapController::class, 'toggleState'])->name('goitap.toggle');

    // LichTap routes
    Route::get('/lichtap', [LichTapController::class, 'lichTapList'])->name('lichtap');
    Route::post('/lichtap/add', [LichTapController::class, 'addLichTap'])->name('lichtap.add');
    Route::get('/lichtap/edit/{id}', [LichTapController::class, 'editLichTap'])->name('lichtap.edit');
    Route::post('/lichtap/update/{id}', [LichTapController::class, 'updateLichTap'])->name('lichtap.update');
    Route::get('/lichtap/delete/{id}', [LichTapController::class, 'deleteLichTap'])->name('lichtap.delete');

    // DungCu routes
    Route::get('/dungcu', [DungCuController::class, 'dungCuList'])->name('dungcu');
          Route::post('/dungcu/add', [DungCuController::class, 'addDungCu'])->name('dungcu.add');
      Route::get('/dungcu/edit/{id}', [DungCuController::class, 'editDungCu'])->name('dungcu.edit');
      Route::post('/dungcu/update/{id}', [DungCuController::class, 'updateDungCu'])->name('dungcu.update');
      Route::get('/dungcu/delete/{id}', [DungCuController::class, 'deleteDungCu'])->name('dungcu.delete');

    // DanhMucDungCu routes
    Route::get('/danhmucdungcu', [DanhMucDungCuController::class, 'danhMucDungCuList'])->name('danhmucdungcu');
    Route::post('/danhmucdungcu/add', [DanhMucDungCuController::class, 'addDanhMucDungCu'])->name('danhmucdungcu.add');
    Route::get('/danhmucdungcu/edit/{id}', [DanhMucDungCuController::class, 'editDanhMucDungCu'])->name('danhmucdungcu.edit');
    Route::post('/danhmucdungcu/update/{id}', [DanhMucDungCuController::class, 'updateDanhMucDungCu'])->name('danhmucdungcu.update');
    Route::get('/danhmucdungcu/delete/{id}', [DanhMucDungCuController::class, 'deleteDanhMucDungCu'])->name('danhmucdungcu.delete');

    // Thống kê doanh thu từ gói tập: chỉ lấy state = 1
    Route::get('/thongke', [GoiTapController::class, 'thongKeGoiTap'])->name('thongke');
    Route::get('/bmi', function () { return view('admin.bmi'); })->name('bmi');
});

// User routes
Route::prefix('user')->name('user.')->group(function () {
    // Trang chủ user
    Route::get('/home', [UserController::class, 'home'])->name('home');
    Route::get('', [UserController::class, 'home'])->name('home-no-slash'); // Thêm route này
    
    // Lớp tập
    Route::get('/classes', [ClassController::class, 'index'])->name('classes');
    Route::get('/class/{id}', [ClassController::class, 'show'])->name('class.detail');
    Route::post('/comment/add', [ClassController::class, 'addComment'])->name('comment.add');
    
    // Lịch tập
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
    Route::get('/schedule1', [ScheduleController::class, 'schedule1'])->name('schedule1');
    Route::get('/schedule2', [ScheduleController::class, 'schedule2'])->name('schedule2');
    
    // Giỏ hàng và thanh toán
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/checkout-page', [CartController::class, 'checkoutPage'])->name('checkout.page');
    Route::get('/checkout1', [OrderController::class, 'checkout1'])->name('checkout1');
    
    // Thông tin khác
    Route::get('/contact', [UserController::class, 'contact'])->name('contact');
    Route::post('/contact/send', [UserController::class, 'sendContact'])->name('contact.send');
    Route::get('/trainer', [TrainerController::class, 'index'])->name('trainer');
    Route::get('/service', [UserController::class, 'service'])->name('service');
    Route::get('/bmi', [UserController::class, 'bmi'])->name('bmi');

    Route::get('/app', [UserController::class, 'app'])->name('app');

    // Route::post('/checkout', [CartController::class, 'checkout'])->name('user.checkout');
    Route::get('/checkout', [OrderController::class, 'checkoutPage'])->name('checkout-page');

    // Hồ sơ người dùng (yêu cầu đăng nhập)
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/profile/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('profile.change-password-form');
        Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
        
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.detail');
        Route::post('/checkout/process', [OrderController::class, 'processCheckout'])->name('checkout.process');
    });
    
});

// Debug route để kiểm tra dữ liệu nhân viên
Route::get('/debug/nhanvien', function() {
    $nhanviens = \App\Models\NhanVien::all();
    foreach($nhanviens as $nv) {
        echo "ID: " . $nv->id . "<br>";
        echo "Tên: " . $nv->tennv . "<br>";
        echo "Image path: " . $nv->image . "<br>";
        echo "Full URL: " . asset($nv->image) . "<br>";
        echo "File exists: " . (file_exists(public_path($nv->image)) ? 'YES' : 'NO') . "<br>";
        echo "<hr>";
    }
});

// Route để sửa dữ liệu trong database
Route::get('/fix/nhanvien-images', function() {
    $nhanviens = \App\Models\NhanVien::all();
    $fixed = 0;
    
    foreach($nhanviens as $nv) {
        $oldPath = $nv->image;
        
        // Sửa đường dẫn từ admin/../uploaded/ thành /admin/uploaded/
        if (strpos($oldPath, 'admin/../uploaded/') === 0) {
            $newPath = '/admin/uploaded/' . basename($oldPath);
            $nv->update(['image' => $newPath]);
            echo "Fixed: {$oldPath} → {$newPath}<br>";
            $fixed++;
        }
        // Sửa đường dẫn từ uploaded/ thành /admin/uploaded/
        elseif (strpos($oldPath, 'uploaded/') === 0) {
            $newPath = '/admin/uploaded/' . basename($oldPath);
            $nv->update(['image' => $newPath]);
            echo "Fixed: {$oldPath} → {$newPath}<br>";
            $fixed++;
        }
    }
    
    echo "<br>Total fixed: {$fixed} records";
});

Route::get('/test', function () {
    return 'Test OK';
});
