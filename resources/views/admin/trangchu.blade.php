@extends('admin.layouts.app')
@section('title', 'Trang chủ Admin')
@push('styles')
<link rel="stylesheet" href="{{ asset('admin/css/trangchuStyle.css') }}">
@endpush
@section('content')

<section class="services-bg">
  <div class="container services">
    <div class="title" >
    <h1 style="margin-bottom: 2rem; font-size: 3rem !important; text-align: center;">Chào mừng bạn đến với <span>hệ thống quản lý phòng gym</span></h1>
    </div>
    <div class="services_boxes">
      <div class="box">
        <a class="nav-link text-white" href="{{ route('admin.nhanvien') }}"><i class="fa-solid fa-person-breastfeeding"></i></a>
        <h4>Nhân viên</h4>
      </div>
      <div class="box br col-sm-6 col-md-4">
        <a class="nav-link text-white" href="{{ route('admin.khachhang') }}"><i class="fa-sharp fa-solid fa-person"></i></a>
        <h4>Khách hàng</h4>
      </div>
      <div class="box col-sm-6 col-md-4">
        <a class="nav-link text-white" href="{{ route('admin.pt') }}"><i class="fa-solid fa-people-group"></i></a>
        <h4>PT</h4>
      </div>
      <div class="box col-sm-6 col-md-4">
        <a class="nav-link text-white" href="{{ route('admin.dungcu') }}"><i class="fa-solid fa-dumbbell"></i></a>
        <h4>Dụng cụ</h4>
      </div>
      <div class="box col-sm-6 col-md-4">
        <a class="nav-link text-white" href="{{ route('admin.thongke') }}"><i class="fa-solid fa-money-check-dollar"></i></a>
        <h4>Doanh thu</h4>
      </div>
      <div class="box col-sm-6 col-md-4">
        <a class="nav-link text-white" href="{{ route('admin.bmi') }}"><i class="fa-sharp fa-solid fa-list-check"></i></a>
        <h4>Kiểm tra chỉ số BMI</h4>
      </div>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <div class="box col-sm-6 col-md-4">
          <button type="submit" class="nav-link text-white"><i class="fa-solid fa-right-from-bracket"></i></button>
          <h4>Đăng xuất</h4>
        </div>
      </form>
      <div class="box col-sm-6 col-md-4">
        <a class="nav-link text-white" href="#"><i class="fa-solid fa-user-plus"></i></a>
        <h4>Thay đổi mật khẩu</h4>
      </div>
    </div>
  </div>
</section>

@endsection