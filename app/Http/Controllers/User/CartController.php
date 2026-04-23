<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DanhMucLopTap;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('user.cart');
    }

    public function add(Request $request)
    {
        $categoryId = $request->input('category_id');
        $package = DanhMucLopTap::findOrFail($categoryId);

        // Thêm vào session cart
        if (!session()->has('cart')) {
            session(['cart' => []]);
        }
        
        $cart = session('cart');
        $cart[$package->id] = [
            'training_name' => $package->category_name,
            'price' => $package->price,
            'duration_days' => $package->duration_days,
            'category_id' => $package->id ?? null,
            
        ];
        
        session(['cart' => $cart]);

        // dd(session('cart'));

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    public function remove($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);
        
        return redirect()->back()->with('success', 'Đã xóa khỏi giỏ hàng!');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Đã xóa giỏ hàng!');
    }

    public function updateQuantity(Request $request, $id)
    {
        $quantity = $request->input('quantity', 1);
        $cart = session('cart', []);
        
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, $quantity);
            session(['cart' => $cart]);
        }
        
        return redirect()->back()->with('success', 'Cập nhật số lượng thành công!');
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

        return redirect()->route('user.checkout.page');
    }

    
}
