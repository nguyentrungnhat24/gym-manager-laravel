<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('user.home') }}">
            <!--<img src="{{ asset('user/images/logo.png') }}" alt="Stamina" class="logo">-->
            Stamina
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->routeIs('user.home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.home') }}">Trang chủ</a>
                </li>

                <li class="nav-item {{ request()->routeIs('user.classes*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.classes') }}">Lớp tập</a>
                </li>

                <li class="nav-item {{ request()->routeIs('user.schedule*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.schedule') }}">Lịch tập</a>
                </li>

                <li class="nav-item {{ request()->routeIs('user.trainer') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.trainer') }}">Huấn luyện viên</a>
                </li>



                <li class="nav-item {{ request()->routeIs('user.bmi') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.bmi') }}">BMI</a>
                </li>

                <li class="nav-item {{ request()->routeIs('user.contact') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.contact') }}">Liên hệ</a>
                </li>

                <li class="nav-item {{ request()->routeIs('user.cart') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.cart') }}">
                        <i class="fa fa-shopping-cart"></i> Giỏ hàng
                        @if(session('cart'))
                        <span class="badge badge-pill badge-primary">{{ count(session('cart')) }}</span>
                        @endif
                    </a>
                </li>

                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('signin') }}">Đăng nhập</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('signup') }}">Đăng ký</a>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.profile') }}">Hồ sơ</a>
                        <a class="dropdown-item" href="{{ route('user.orders') }}">Đơn hàng</a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="dropdown-item">Đăng xuất</button>
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>