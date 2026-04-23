@extends('user.layouts.app')

@section('title', 'Trang chủ - Stamina Gym')

@section('content')
<!-- Hero Section -->
<div class="intro-section" id="home-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
                <h1 class="mb-3">Không có sự đau đớn, không có sự thay đổi.</h1>
                <p class="lead mx-auto desc mb-5">Hãy là phiên bản tốt nhất của chính bạn.</p>
                <p class="text-center">
                    <a href="{{ route('user.classes') }}" class="btn btn-outline-white py-3 px-5">BẮT ĐẦU</a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Operating Hours Section -->
<div class="schedule-wrap2 clearfix">
    <div class="d-md-flex align-items-center">
        <div class="hours mr-md-4 mb-4 mb-lg-0">
            <strong class="d-block">Giờ hoạt động</strong>
            Mở cửa: 7:30 &mdash;
            Đóng cửa: 21:00
        </div>
        <div class="cta ml-auto">
            <a href="{{ route('user.contact') }}" class="smoothscroll d-flex d-md-flex align-items-center btn">
                <span class="mx-auto">
                    <span>LIÊN HỆ</span>
                    <span class="arrow icon-keyboard_arrow_right"></span>
                </span>
            </a>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="site-section" id="features-section">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-md-8 section-heading">
                <h2 class="heading mb-3">Dịch vụ của chúng tôi</h2>
                <p>Stamina Gym cung cấp các dịch vụ chuyên nghiệp để giúp bạn đạt được mục tiêu fitness</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-item text-center">
                    <div class="icon mb-3">
                        <i class="icon-dumbbell"></i>
                    </div>
                    <h3>Lớp tập đa dạng</h3>
                    <p>Tham gia các lớp tập từ cơ bản đến nâng cao với huấn luyện viên chuyên nghiệp</p>
                    <a href="{{ route('user.classes') }}" class="btn btn-primary">Xem lớp tập</a>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-item text-center">
                    <div class="icon mb-3">
                        <i class="icon-person"></i>
                    </div>
                    <h3>Huấn luyện viên chuyên nghiệp</h3>
                    <p>Đội ngũ PT giàu kinh nghiệm sẽ hướng dẫn và hỗ trợ bạn trong quá trình tập luyện</p>
                    <a href="{{ route('user.trainer') }}" class="btn btn-primary">Gặp PT</a>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-item text-center">
                    <div class="icon mb-3">
                        <i class="icon-calendar"></i>
                    </div>
                    <h3>Lịch tập linh hoạt</h3>
                    <p>Xem lịch tập và đăng ký các buổi tập phù hợp với thời gian của bạn</p>
                    <a href="{{ route('user.schedule') }}" class="btn btn-primary">Xem lịch</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Section -->
<div class="site-section bg-light" id="about-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="heading mb-4">Về Stamina Gym</h2>
                <p>Stamina Gym là phòng tập chuyên nghiệp với trang thiết bị hiện đại, không gian rộng rãi và đội ngũ huấn luyện viên giàu kinh nghiệm. Chúng tôi cam kết mang đến cho bạn môi trường tập luyện tốt nhất để đạt được mục tiêu fitness.</p>
                <ul class="list-unstyled">
                    <li><i class="icon-check text-primary"></i> Trang thiết bị hiện đại</li>
                    <li><i class="icon-check text-primary"></i> Huấn luyện viên chuyên nghiệp</li>
                    <li><i class="icon-check text-primary"></i> Không gian thoáng mát</li>
                    <li><i class="icon-check text-primary"></i> Lịch tập linh hoạt</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('user/images/img_1.jpg') }}" alt="Gym Equipment" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="site-section bg-primary" id="cta-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-8">
                <h2 class="text-white mb-4">Sẵn sàng bắt đầu hành trình fitness?</h2>
                <p class="text-white mb-4">Tham gia ngay hôm nay để nhận được tư vấn miễn phí và khuyến mãi đặc biệt</p>
                <a href="{{ route('user.contact') }}" class="btn btn-outline-white btn-lg">Liên hệ ngay</a>
            </div>
        </div>
    </div>
</div>

<!-- Video background nếu cần -->
<a id="bgndVideo" class="player" data-property="{videoURL:'https://www.youtube.com/watch?v=w-cRWOjlk8c',showYTLogo:false, showAnnotations: false, showControls: false, cc_load_policy: false, containment:'#home-section',autoPlay:true, mute:true, startAt:255, stopAt: 271, opacity:1}">
</a>
@endsection

@push('styles')
<style>
.intro-section {
    background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset("user/images/bg_1.jpg") }}') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    display: flex;
    align-items: center;
    color: white;
}

.schedule-wrap2 {
    background: #dc3545;
    color: white;
    padding: 20px 0;
}

.schedule-wrap2 .btn {
    background: #fd7e14;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
}

.feature-item {
    padding: 30px 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    height: 100%;
}

.feature-item .icon {
    font-size: 3rem;
    color: #007bff;
}

.bg-primary {
    background-color: #007bff !important;
}

.btn-outline-white {
    border: 2px solid white;
    color: white;
    background: transparent;
}

.btn-outline-white:hover {
    background: white;
    color: #007bff;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Khởi tạo video background nếu cần
    if (typeof $.fn.mb_YTPlayer !== 'undefined') {
        $("#bgndVideo").mb_YTPlayer();
    }
    
    // Smooth scroll cho các link
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top
            }, 1000);
        }
    });
});
</script>
@endpush
