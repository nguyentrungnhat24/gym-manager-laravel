<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5"></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10 position-relative">
                <div class="wrap d-md-flex">
                    <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                        <div class="imgcontainer position-absolute fixed-top mb-3">
                            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal"><i class="fa fa-times" aria-hidden="true"></i></span>
                        </div>
                        <div class="text w-100">
                            <h2>Chào mừng bạn đến với đăng nhập</h2>
                            <p>Bạn đã có tài khoản chưa?</p>
                            <a href="#" onclick="document.getElementById('id02').style.display='block'; document.getElementById('id01').style.display='none'" class="btn btn-white btn-outline-white">Đăng kí</a>
                        </div>
                    </div>
                    <div class="login-wrap p-4 p-lg-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">Đăng nhập</h3>
                            </div>
                            <div class="w-100">
                                <p class="social-media d-flex justify-content-end">
                                    <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                    <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                </p>
                            </div>
                        </div>
                        <form action="{{ route('check_login') }}" class="signin-form" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="label" for="name">Tài khoản</label>
                                <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                                @error('username')
                                    <span class="text-warning">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="password">Mật khẩu</label>
                                <input type="password" name="password" class="form-control" required>
                                @error('password')
                                    <span class="text-warning">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="form-control btn btn-primary submit px-3">Đăng nhập</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50 text-left">
                                    <label class="checkbox-wrap checkbox-primary mb-0">Nhớ mật khẩu
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="#">Quên mật khẩu</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{ asset('signin_signup/js/jquery.min.js') }}"></script>
<script src="{{ asset('signin_signup/js/popper.js') }}"></script>
<script src="{{ asset('signin_signup/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('signin_signup/js/main.js') }}"></script>

</body>
</html>
