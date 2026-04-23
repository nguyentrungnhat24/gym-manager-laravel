@extends('user.layouts.app')

@section('title', 'Thanh toán')

@section('content')
<main role="main">
    <div class="container mt-4">
        <form class="needs-validation" method="POST" action="{{ route('user.checkout.process') }}">
            @csrf
            <div class="py-5 text-center">
                <i class="fa fa-credit-card fa-4x" aria-hidden="true"></i>
                <h2>Thanh toán</h2>
                <p class="lead">Vui lòng kiểm tra thông tin Khách hàng, thông tin Giỏ hàng trước khi Đặt hàng.</p>
            </div>

            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Giỏ hàng</span>
                        <span class="badge badge-secondary badge-pill">{{ count($checkoutCart) }}</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @php $tong = 0; @endphp
                        @foreach($checkoutCart as $id => $item)
                        @php
                        $s = $item['price'] * ($item['quantity'] ?? 1);
                        $tong += $s;
                        @endphp
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ $item['training_name'] ?? $item['name'] ?? 'Không có tên' }}</h6>
                                <small class="text-muted">{{ number_format($item['price'], 0) }} VND</small>
                            </div>
                            <span class="text-muted">{{ number_format($s, 0) }} VND</span>
                        </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Tổng thành tiền</span>
                            <strong>{{ number_format($tong, 0) }} VND</strong>
                        </li>
                    </ul>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Mã khuyến mãi" name="coupon">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-secondary">Xác nhận</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Thông tin khách hàng</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="kh_ten">Họ tên</label>
                            <input type="text" class="form-control" name="kh_ten" id="kh_ten"
                                value="{{ session('fullname') ?? Auth::user()->full_name ?? '' }}" required>
                        </div>
                        <div class="col-md-12">
                            <label for="kh_diachi">Địa chỉ</label>
                            <input type="text" class="form-control" name="kh_diachi" id="kh_diachi"
                                value="{{ session('address') ?? Auth::user()->address ?? '' }}" required>
                        </div>
                        <div class="col-md-12">
                            <label for="kh_dienthoai">Điện thoại</label>
                            <input type="text" class="form-control" name="kh_dienthoai" id="kh_dienthoai"
                                value="{{ session('phone_number') ?? Auth::user()->phone_number ?? '' }}" required>
                        </div>
                        <div class="col-md-12">
                            <label for="kh_email">Email</label>
                            <input type="email" class="form-control" name="kh_email" id="kh_email"
                                value="{{ session('email') ?? Auth::user()->email ?? '' }}" required>
                        </div>
                    </div>
                    <h4 class="mb-3">Hình thức thanh toán</h4>
                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="httt-1" name="httt_ma" type="radio" class="custom-control-input" required
                                value="1">
                            <label class="custom-control-label" for="httt-1">Tiền mặt</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="httt-2" name="httt_ma" type="radio" class="custom-control-input" required
                                value="2">
                            <label class="custom-control-label" for="httt-2">Chuyển khoản</label>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit" name="btnMuaGoi">Mua gói</button>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection