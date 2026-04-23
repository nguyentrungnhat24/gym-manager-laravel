<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Stamina - Gym Website')</title>
    
    <meta name="description" content="@yield('description', 'Website phòng gym chuyên nghiệp')" />
    <meta name="keywords" content="@yield('keywords', 'gym, fitness, workout, health')" />
    <meta name="author" content="Gym Website" />

    <link rel="shortcut icon" href="{{ asset('user/ftco-32x32.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('user/fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/jquery.mb.YTPlayer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/app.css') }}">
    
    @stack('styles')
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <!-- Header -->
    @include('user.layouts.header')
    
    <!-- Main Content -->
    <main role="main">
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
        
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('user.layouts.footer')
    
    <!-- Scripts -->
    <script src="{{ asset('user/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('user/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('user/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('user/js/popper.min.js') }}"></script>
    <script src="{{ asset('user/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('user/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('user/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('user/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('user/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('user/js/aos.js') }}"></script>
    <script src="{{ asset('user/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('user/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('user/js/jquery.mb.YTPlayer.min.js') }}"></script>
    <script src="{{ asset('user/js/main.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
