<footer class="ftco-footer ftco-section img bg-dark">
    <div class="overlay"></div>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2 text-white">Về Stamina Gym</h2>
                    <p class="text-light">Stamina Gym - Phòng tập chuyên nghiệp với đội ngũ huấn luyện viên giàu kinh nghiệm, trang thiết bị hiện đại và môi trường tập luyện thân thiện. Chúng tôi cam kết mang đến cho bạn trải nghiệm fitness tốt nhất.</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                        <li class="ftco-animate"><a href="#" class="text-white"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#" class="text-white"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#" class="text-white"><span class="icon-instagram"></span></a></li>
                        <li class="ftco-animate"><a href="#" class="text-white"><span class="icon-youtube"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4 ml-md-5">
                    <h2 class="ftco-heading-2 text-white">Dịch vụ chính</h2>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('user.classes') }}" class="py-2 d-block text-light">Lớp tập đa dạng</a></li>
                        <li><a href="{{ route('user.trainer') }}" class="py-2 d-block text-light">Huấn luyện viên cá nhân</a></li>
                        <li><a href="{{ route('user.schedule') }}" class="py-2 d-block text-light">Lịch tập linh hoạt</a></li>
                        <li><a href="{{ route('user.bmi') }}" class="py-2 d-block text-light">Tính chỉ số BMI</a></li>
                        
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2 text-white">Liên hệ</h2>
                    <div class="block-23 mb-3">
                        <ul class="text-light">
                            <li><span class="icon icon-map-marker text-primary"></span><span class="text">123 Đường ABC, Quận XYZ, TP.HCM</span></li>
                            <li><a href="tel:+84123456789" class="text-light"><span class="icon icon-phone text-primary"></span><span class="text">+84 123 456 789</span></a></li>
                            <li><a href="mailto:info@stamina.com" class="text-light"><span class="icon icon-envelope text-primary"></span><span class="text">info@stamina.com</span></a></li>
                            <li><span class="icon icon-clock-o text-primary"></span><span class="text">Hỗ trợ 24/7</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2 text-white">Giờ hoạt động</h2>
                    <div class="opening-hours">
                        <div class="text-light">
                            <p class="mb-2"><strong>Thứ 2 - Thứ 6:</strong> 7:30 - 21:00</p>
                            <p class="mb-2"><strong>Thứ 7:</strong> 7:30 - 20:00</p>
                            <p class="mb-2"><strong>Chủ nhật:</strong> 8:00 - 18:00</p>
                            <hr class="bg-light">
                            <p class="mb-0"><small class="text-muted">* Ngày lễ: 8:00 - 18:00</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="border-top pt-4">
                    <p class="text-light mb-0">
                        Copyright &copy; {{ date('Y') }} <strong>Stamina Gym</strong>. All rights reserved | 
                        <a href="{{ route('user.contact') }}" class="text-primary">Liên hệ</a> | 
                        <a href="#" class="text-primary">Chính sách bảo mật</a> | 
                        <a href="#" class="text-primary">Điều khoản sử dụng</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
