<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GoiTap;
use App\Models\DanhMucLopTap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Lấy danh sách đơn hàng của user
        // $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        
        return view('user.orders');
    }

    public function show($id)
    {
        // $order = Order::where('user_id', Auth::id())->findOrFail($id);
        // return view('user.order-detail', compact('order'));
        
        return view('user.order-detail');
    }

    public function checkout(Request $request)
    {
        $selected = $request->input('selected_items', []);
        $cart = session('cart', []);
        $checkoutCart = [];

        foreach ($selected as $id) {
            if (isset($cart[$id])) {
                $checkoutCart[$id] = $cart[$id];
            }
        }

        session(['checkout_cart' => $checkoutCart]);

        return redirect()->route('user.checkout-page');
    }

    public function checkoutPage()
    {
        $checkoutCart = session('checkout_cart', []);
        
        // Lấy thông tin người dùng từ session
        $userId = intval(session('user_id', 0));
        $userName = session('username');
        
        // Kiểm tra nếu người dùng đã đăng nhập qua Auth
        if (Auth::check()) {
            $authUser = Auth::user();
            // Cập nhật session user_id để đảm bảo có giá trị số nguyên đúng
            if ($authUser->id) {
                session(['user_id' => $authUser->id]);
            }
        }
        
        // Chuẩn bị dữ liệu để truyền vào view
        $userData = [
            'name' => session('full_name', ''),
            'address' => session('address', ''),
            'phone' => session('phone_number', ''),
            'email' => session('email', '')
        ];
        
        return view('user.checkout', compact('checkoutCart', 'userData'));
    }

    public function checkout1()
    {
        return view('user.checkout1');
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'kh_ten' => 'required|string|max:255',
            'kh_email' => 'required|email',
            'kh_dienthoai' => 'required|string|max:20',
            'kh_diachi' => 'required|string|max:500',
            'httt_ma' => 'required|in:1,2' // 1: Tiền mặt, 2: Chuyển khoản
        ]);

        // Lấy thông tin giỏ hàng từ session
        $checkoutCart = session('checkout_cart', []);
        
        if (empty($checkoutCart)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống, không thể thanh toán!');
        }
        
        // Lưu thông tin khách hàng vào session để sử dụng cho lần sau
        session([
            'full_name' => $request->kh_ten,
            'address' => $request->kh_diachi,
            'phone_number' => $request->kh_dienthoai,
            'email' => $request->kh_email
        ]);

        try {
            // Lấy user_id từ session - biết chắc chắn rằng đây là số nguyên 3
            $userId = session('user_id');
            
            // Kiểm tra tính hợp lệ của user_id
            if (!is_numeric($userId) || $userId <= 0) {
                return redirect()->back()->with('error', 'Không thể xác định người dùng. Vui lòng đăng nhập lại!');
            }
            
            // Chuyển đổi sang số nguyên
            $userId = intval($userId);
                
            // Kiểm tra xem $userId có hợp lệ không và log để debug
            \Illuminate\Support\Facades\Log::info('UserId check', ['userId' => $userId, 'type' => gettype($userId)]);

            if (!$userId || $userId <= 0) {
                return redirect()->back()->with('error', 'Không thể xác định người dùng. Vui lòng đăng nhập lại!');
            }
            
            $paymentMethod = $request->httt_ma == 1 ? 'cash' : 'bank_transfer';
            $currentDate = date('Y-m-d');
            
            // Tính tổng tiền
            $totalAmount = 0;
            foreach ($checkoutCart as $id => $item) {
                $totalAmount += $item['price'] * ($item['quantity'] ?? 1);
            }
    
            // Xử lý mua gói tập cho từng item trong giỏ hàng
            foreach ($checkoutCart as $id => $item) {
                // Lấy thông tin gói tập từ database
                $goiTapInfo = DanhMucLopTap::allActive()->find($id);
                
                if ($goiTapInfo) {
                    // Tính ngày kết thúc dựa trên thời hạn gói tập
                    $endDate = date('Y-m-d', strtotime($currentDate . ' + ' . $goiTapInfo->duration_days . ' days'));
                    
                    try {
                        // Hiển thị cấu trúc của session cart để kiểm tra
                        $cart = $request->session()->get('cart');
                        $checkoutCart = session('checkout_cart');
                        
                        // Hiển thị tất cả session để xem cấu trúc
                        // dd([
                        //     'all_session' => $request->session()->all(),
                        //     'cart_session' => $cart,
                        //     'checkout_cart_session' => $checkoutCart,
                        //     'item_id' => $id,
                        //     'current_item' => $item
                        // ]);
                        
                        // Khởi tạo mảng dữ liệu để insert (sẽ không được thực thi do dd() phía trên)
                        $goiTapData = [
                            'training_name' => $item['training_name'],
                            'price' => $item['price'],
                            'quantity' => $item['quantity'] ?? 1,
                            'duration_days' => $goiTapInfo->duration_days,
                            'category_id' => $item['category_id'],
                            'user_id' => intval($userId), // Đảm bảo là số nguyên
                            'customer_name' => $request->kh_ten,
                            'customer_address' => $request->kh_diachi,
                            'customer_phone' => $request->kh_dienthoai,
                            'customer_email' => $request->kh_email,
                            'start_date' => $currentDate,
                            'end_date' => $endDate,
                            'status' => 'active',
                            'deleted' => 0
                        ];


                        // Sử dụng phương thức tạo mới an toàn
                        GoiTap::create($goiTapData);
                        
                        // Ghi log thành công để debug
                        \Illuminate\Support\Facades\Log::info('Tạo gói tập thành công', [
                            'user_id' => $userId,
                            'training_name' => $goiTapInfo->training_name
                        ]);
                    } catch (\Exception $innerEx) {
                        \Illuminate\Support\Facades\Log::error('Lỗi khi tạo gói tập', [
                            'error' => $innerEx->getMessage(),
                            'user_id' => $userId
                        ]);
                        throw $innerEx; // Ném lại ngoại lệ để xử lý ở catch bên ngoài
                    }
                }
            }
            
            // Xóa giỏ hàng sau khi thanh toán thành công
            session()->forget('checkout_cart');
            session()->forget('cart');
            
            return redirect()->route('user.orders')->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi xử lý đơn hàng: ' . $e->getMessage());
        }
    }
}