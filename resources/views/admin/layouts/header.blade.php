<header class="admin-header" style="margin-bottom:0; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
    <nav class="navbar navbar-expand-lg" style="background: #219150; margin-bottom:0; min-height: 120px;">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-white d-flex align-items-center"
               style="font-size:2.5rem; letter-spacing:2.5px; padding: 0 20px; margin-right: 32px;" href="{{ route('admin.trangchu') }}">FITNESS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarResponsive" aria-controls="navbarResponsive"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarResponsive">
                <ul class="navbar-nav mb-2 mb-lg-0 gap-lg-4"
                    style="font-size:2rem; text-transform:uppercase; font-weight:700; letter-spacing:1px;">
                    <li class="nav-item"><a class="nav-link text-white fw-bold @if(request()->routeIs('admin.trangchu')) active @endif"
                        style="padding: 12px 18px; border-radius: 8px;" href="{{ route('admin.trangchu') }}">TRANG CHỦ</a></li>
                    <li class="nav-item"><a class="nav-link text-white @if(request()->routeIs('admin.nhanvien')) active @endif"
                        style="padding: 12px 18px; border-radius: 8px;" href="{{ route('admin.nhanvien') }}">NHÂN VIÊN</a></li>
                    <li class="nav-item"><a class="nav-link text-white @if(request()->routeIs('admin.khachhang')) active @endif"
                        style="padding: 12px 18px; border-radius: 8px;" href="{{ route('admin.khachhang') }}">KHÁCH HÀNG</a></li>
                    <li class="nav-item"><a class="nav-link text-white @if(request()->routeIs('admin.pt')) active @endif"
                        style="padding: 12px 18px; border-radius: 8px;" href="{{ route('admin.pt') }}">PT</a></li>
                    <li class="nav-item"><a class="nav-link text-white @if(request()->routeIs('admin.dungcu')) active @endif"
                        style="padding: 12px 18px; border-radius: 8px;" href="{{ route('admin.dungcu') }}">DỤNG CỤ</a></li>
                    <li class="nav-item"><a class="nav-link text-white @if(request()->routeIs('admin.lichtap')) active @endif"
                        style="padding: 12px 18px; border-radius: 8px;" href="{{ route('admin.lichtap') }}">LỊCH TẬP</a></li>
                    <li class="nav-item"><a class="nav-link text-white @if(request()->routeIs('admin.goitap')) active @endif"
                        style="padding: 12px 18px; border-radius: 8px;" href="{{ route('admin.goitap') }}">GÓI TẬP</a></li>
                    <li class="nav-item"><a class="nav-link text-white @if(request()->routeIs('admin.thongke')) active @endif"
                        style="padding: 12px 18px; border-radius: 8px;" href="{{ route('admin.thongke') }}">DOANH THU</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>