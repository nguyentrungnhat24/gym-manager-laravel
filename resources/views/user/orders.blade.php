@extends('user.layouts.app')

@section('title', 'Đơn hàng của tôi')

@section('content')
<div class="container mt-5">
    <h2>Đơn hàng của tôi</h2>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Hiển thị danh sách đơn hàng ở đây --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
