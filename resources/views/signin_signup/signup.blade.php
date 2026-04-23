<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <!-- <h2 class="heading-section bg-body-secondary">Sign Up #07</h2> -->
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10 position-relative">
                <div class="wrap d-md-flex">
                    <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                        <div class="imgcontainer position-absolute fixed-top mb-3">
                            <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal"><i class="fa fa-times" aria-hidden="true"></i></span>
                        </div>
                        <div class="text w-100">
                            <h2>Chào mừng đến với đăng kí</h2>
                            <p>Bạn đã có tài khoản?</p>
                            <a href="#" onclick="document.getElementById('id01').style.display='block'; document.getElementById('id02').style.display='none'" class="btn btn-white btn-outline-white">Đăng nhập</a>
                        </div>
                    </div>
                    <div class="login-wrap p-4 p-lg-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">Đăng kí</h3>
                            </div>
                            <div class="w-100">
                                <p class="social-media d-flex justify-content-end">
                                    <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                    <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                </p>
                            </div>
                        </div>
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('register') }}" class="signin-form" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="label" for="name">Họ và tên</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="text-warning">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="username">Tài khoản</label>
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
                            <div class="form-group mb-3">
                                <label class="label" for="repassword">Nhập lại mật khẩu</label>
                                <input type="password" name="repassword" class="form-control" required>
                                @error('repassword')
                                    <span class="text-warning">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="address">Địa chỉ</label>
                                <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
                                @error('address')
                                    <span class="text-warning">{{ $message }}</span>
                                @enderror
                            </div>	
                            <div class="form-group mb-3">
                                <label class="label" for="phone_number">Số điện thoại</label>
                                <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
                                @error('phone_number')
                                    <span class="text-warning">{{ $message }}</span>
                                @enderror
                            </div>						
                            <div class="form-group mb-3">
                                <label class="label" for="email">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" id="txtEmail" value="{{ old('email') }}" aria-describedby="msgEmail" required>
                                <span class="text-warning">
                                    <p id="msgEmail"></p>
                                </span>
                                @error('email')
                                    <span class="text-warning">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" onclick="return ktEmail('txtEmail','msgEmail','Sai định dạng Email !')" class="form-control btn btn-primary submit px-3">Đăng ký</button>
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

<script>
    function ktEmail(idTag, idMsg, msg) {
        var idTag = document.getElementById(idTag);
        var idMsg = document.getElementById(idMsg);
        var valueInput = idTag.value;
        var redExr = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
        if (!redExr.test(valueInput)) {
            idMsg.style.display = "block";
            idMsg.innerHTML = msg;
            return false;
        } else {
            idMsg.style.display = "none";
            return true;
        }
    }
</script>

<script src="{{ asset('signin_signup/js/jquery.min.js') }}"></script>
<script src="{{ asset('signin_signup/js/popper.js') }}"></script>
<script src="{{ asset('signin_signup/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('signin_signup/js/main.js') }}"></script>