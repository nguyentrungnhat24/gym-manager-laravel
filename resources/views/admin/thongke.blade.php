@extends('admin.layouts.app')
@section('title', 'Thống kê Gói Tập')
@section('content')
<div class="container section">
  <section class="attendance">
    <div class="attendance-list" style="max-width:1100px; margin:0 auto; background:#fff; border-radius:18px; box-shadow:0 8px 24px rgba(0,0,0,0.13); padding:32px 24px 32px 24px;">
      <h2 class="title" style="font-size:2.2rem; text-shadow:2px 2px 4px #333; margin-bottom:24px;">THỐNG KÊ CÁC GÓI ĐĂNG KÍ</h2>

      <table class="table table-bordered table-hover" style="font-size:1.05rem; border-radius:14px; overflow:hidden; background:#fff;">
        <thead style="background:#219150; color:#fff;">
          <tr style="height:56px;">
            <th style="text-align:center;">ID</th>
            <th style="text-align:center;">Tên lớp tập</th>
            <th style="text-align:center;">Giá</th>
            <th style="text-align:center;">Số lượng</th>
            <th style="text-align:center;">Thời gian</th>
            <th style="text-align:center;">Tên khách hàng</th>
            <th style="text-align:center;">Địa chỉ</th>
            <th style="text-align:center;">Số điện thoại</th>
            <th style="text-align:center;">Email</th>
            <th style="text-align:center;">Trạng thái</th>
          </tr>
        </thead>
        <tbody>
          @forelse($dsgoitap as $gt)
          <tr style="height:64px; vertical-align:middle;">
            <td style="text-align:center;">{{ $gt['id'] }}</td>
            <td style="text-align:center; font-weight:500;">{{ $gt['tenloptap'] }}</td>
            <td style="text-align:center;">{{ number_format($gt['gia']) }}</td>
            <td style="text-align:center;">{{ $gt['soluong'] }}</td>
            <td style="text-align:center;">{{ $gt['thoigian'] }}</td>
            <td style="text-align:center;">{{ $gt['tenkh'] }}</td>
            <td style="text-align:center;">{{ $gt['diachi'] }}</td>
            <td style="text-align:center;">{{ $gt['sdt'] }}</td>
            <td style="text-align:center;">{{ $gt['email'] }}</td>
            <td style="text-align:center;">
              <span class="badge bg-success" style="font-size:1rem; padding:.6rem .8rem;">Đã thanh toán</span>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="10" class="text-center">Chưa có gói nào được duyệt</td>
          </tr>
          @endforelse
        </tbody>
        @isset($tongtien)
        <tfoot>
          <tr>
            <td colspan="9" style="text-align:right; font-weight:700;">Tổng tiền thu được:</td>
            <td style="background:#f7c948; font-weight:700;">{{ number_format($tongtien) }} vnđ</td>
          </tr>
        </tfoot>
        @endisset
      </table>
    </div>
  </section>
  </div>
@endsection


