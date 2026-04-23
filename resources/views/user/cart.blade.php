@extends('user.layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
<main role="main" class="mt-5">
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h1 class="text-center mb-4">Giỏ hàng</h1>
        
        @if(session('cart') && count(session('cart')) > 0)
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.checkout') }}">
                                @csrf
                                <table class="table table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th width="5%">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="selectAll">
                                                    <label class="form-check-label" for="selectAll"></label>
                                                </div>
                                            </th>
                                            <th width="15%">Tên gói tập</th>
                                            <th width="15%">Giá</th>
                                            <th width="10%">Thời gian</th>
                                            <th width="10%">Số lượng</th>
                                            <th width="15%">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach(session('cart') as $id => $item)
                                            @php
                                                $qty = isset($item['quantity']) ? $item['quantity'] : 1;
                                                $total += $item['price'] * $qty;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input item-checkbox" 
                                                               name="selected_items[]" value="{{ $id }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-0">{{ $item['training_name']?? 'Không có tên' }}</h6>
                                                            <small class="text-muted">ID: {{ $id }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fw-bold text-primary">
                                                        {{ number_format($item['price'], 0, ',', '.') }} VNĐ
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">{{ $item['duration_days'] }}</span>
                                                </td>
                                                
                                                
                                                <td>
                                                    {{ $qty }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('user.cart.remove', $id) }}" 
                                                       class="btn btn-danger btn-sm"
                                                       onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                                        <i class="fa fa-trash"></i> Xóa
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <h5 class="card-title">Tổng quan</h5>
                                                <p class="card-text">
                                                    <strong>Số lượng:</strong> {{ count(session('cart')) }} lớp tập<br>
                                                    <strong>Tổng tiền:</strong> 
                                                    <span class="text-primary fw-bold fs-5">
                                                        {{ number_format($total, 0, ',', '.') }} VNĐ
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex flex-column gap-2">
                                            <button type="submit" class="btn btn-primary btn-lg" name="btnThanhToan">
                                                <i class="fa fa-credit-card"></i> Thanh toán
                                            </button>
                                            <a href="{{ route('user.cart.clear') }}" 
                                               class="btn btn-outline-danger"
                                               onclick="return confirm('Bạn có chắc muốn xóa toàn bộ giỏ hàng?')">
                                                <i class="fa fa-trash"></i> Xóa giỏ hàng
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fa fa-shopping-cart fa-4x text-muted"></i>
                </div>
                <h3 class="text-muted">Giỏ hàng trống</h3>
                <p class="text-muted">Bạn chưa có sản phẩm nào trong giỏ hàng.</p>
                <a href="{{ route('user.classes') }}" class="btn btn-primary">
                    <i class="fa fa-arrow-left"></i> Xem các lớp tập
                </a>
            </div>
        @endif

        
    </div>
</main>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Select all functionality
    $('#selectAll').change(function() {
        $('.item-checkbox').prop('checked', $(this).is(':checked'));
    });

    // Update select all when individual checkboxes change
    $('.item-checkbox').change(function() {
        if (!$(this).is(':checked')) {
            $('#selectAll').prop('checked', false);
        } else {
            var allChecked = true;
            $('.item-checkbox').each(function() {
                if (!$(this).is(':checked')) {
                    allChecked = false;
                    return false;
                }
            });
            $('#selectAll').prop('checked', allChecked);
        }
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
});
</script>
@endpush