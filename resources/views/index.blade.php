<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ======== Favicon ======= -->
    <link rel="shortcut icon" href="{{ asset('user/images/favicon.ico') }}" type="image/x-icon" />
    <!-- ======== Boxicons ======= -->
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <!-- ======== Slider Js ======= -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.7.5/swiper-bundle.min.css"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ======== StyleSheet ======= -->
    <link rel="stylesheet" href="{{ asset('/admin/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('signin_signup/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('signin_signup/css/modal.css') }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Quản lý phòng GYM</title>
    
  </head>
  <body>
  <div id="id01" class="modal">
    
    <!-- Include form signin -->
    @include('signin_signup.signin')
    
  </div>
  <div id="id02" class="modal">
    
    <!-- Include form signup -->
    @include('signin_signup.signup')
    
  </div>
  
<script>
    function ktNhap(idTag, idMsg, msg) {
            var idTag = document.getElementById(idTag);
            var idMsg = document.getElementById(idMsg);
            var valueInput = idTag.value;
            if (valueInput == "") {
                idMsg.style.display = "block";
                idMsg.innerHTML = msg;
                return false;
            } else {
                idMsg.style.display = "none";
                return true;
            }
        }

</script>

@if($errors->any())
<script>
    // Tự động hiển thị modal đăng nhập khi có lỗi
    document.addEventListener('DOMContentLoaded', function() {
        // Nếu có lỗi, hiển thị modal đăng nhập
        document.getElementById('id01').style.display = 'block';
    });
</script>
@endif
</script>
    <header class="header" id="header">
      <!-- Navigation -->
      <div class="navigation">
        <nav class="nav d-flex">
          <div class="logo">
            <a href="/">
              <img src="{{ asset('admin/images/uploaded/icon.jpg') }}" />
            </a>
          </div>
          <ul class="nav-list d-flex">
            <li class="nav-item">
              <a href="#header" class="nav-link">Trang chủ</a>
            </li>
            <li class="nav-item">
              <a href="#about" class="nav-link">Giới thiệu</a>
            </li>
            <li class="nav-item">
              <a href="#contact" class="nav-link">Địa chỉ</a>
            </li>
          </ul>

          <div class="auth-buttons d-flex" style="gap: 10px;">
            <button class="btn sign-up bg-primary" style="width:auto;" onclick="document.getElementById('id01').style.display='block'">Đăng nhập</button>
            <button class="btn sign-up bg-success" style="width:auto;" onclick="document.getElementById('id02').style.display='block'">Đăng kí</button>
          </div>
          <div class="hamburger">
            <i class="bx bx-menu-alt-left"></i>
          </div>
        </nav>
      </div>

      <!-- Hero -->
      <div class="swiper-container slider-1">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <img src="https://cdn.shopify.com/s/files/1/1876/4703/articles/sam-moqadam-W8CyjblrF8U-unsplash_2000x.jpg?v=1617748274" alt="" />
          </div>

          <div class="swiper-slide">
            <img src="{{ asset('admin/images/nenphong2.jpg') }}" alt="hero image" />
          </div>
          <div class="swiper-slide">
            <video muted loop autoplay>
              <source src="{{ asset('admin/images/video1 ‐ Được tạo bằng Clipchamp.mp4') }}" type="video/mp4" />
            </video>
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('admin/images/nenphong4.jpg') }}" alt="hero image" />
          </div>

          <div class="swiper-slide">
            <video muted loop autoplay>
              <source src="{{ asset('admin/images/video2 ‐ Được tạo bằng Clipchamp.mp4') }}" type="video/mp4" />

            </video>
          </div>
          <div class="swiper-slide">
            <img src="{{ asset('admin/images/nenphong5.jpg') }}" alt="" />
          </div>

          <div class="swiper-slide">
            <video muted loop autoplay>
              <source src="{{ asset('admin/images/video3 ‐ Được tạo bằng Clipchamp.mp4') }}" type="video/mp4" />
            </video>
          </div>
        </div>
      </div>

      <div class="content">
        <h1 style="width: auto;">
         WELCOME TO <br />
          THE GYM
        </h1>
      </div>

      <div class="arrows d-flex">
        <div class="swiper-prev d-flex">
          <i class="bx bx-chevron-left swiper-icon"></i>
        </div>
        <div class="swiper-next d-flex">
          <i class="bx bx-chevron-right swiper-icon"></i>
        </div>
      </div>
    </header>

    <main class="main">
      <!-- About Section -->
      <section class="section about" id="about">
        <div class="row container">
          <div class="col">
            <div class="title">
              <h1>GIỚI THIỆU</h1>
            </div>
            <p>
              Fitness Club sở hữu phòng tập Gym rộng rãi cùng các trang thiết bị hiện đại và huấn luyện viên chuyên nghiệp sẽ đem đến những trải nghiệm dịch vụ tốt nhất cho khách hàng.
            </p>
            <a href="#" class="btn">Xem thêm</a>
          </div>
          <div class="col">
            <div class="swiper-container slider-2">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <img src="{{ asset('admin/images/about.jpg') }}" alt="hero image" />
                </div>
                <div class="swiper-slide">
                  <video muted loop autoplay>
                    <source src="{{ asset('admin/images/Không gian phòng tập The New Gym Vũng Tàu.mp4') }}" type="video/mp4" />
                  </video>
                </div>
                <div class="swiper-slide">
                  <img src="{{ asset('admin/images/nenphong1.jpg') }}" alt="" />
                </div>
              </div>
              <div class="swiper-button-next">
                <i class="bx bx-chevron-right swiper-icon"></i>
              </div>
              <div class="swiper-button-prev">
                <i class="bx bx-chevron-left swiper-icon"></i>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--  Service Section -->
      <section class="section service" id="service" >

            <div class="container">
                 <div style="display: flex;flex-direction:row;margin-bottom: 50px;">

                        <div style="display: flex;flex-direction: column;padding-right:50px;text-align: center;">
                            <div ><h2>Tư vấn miễn phí</h2></div>
                            <div> <img class="img-fluid" style="width: 350px;height: 260px;margin-top: 15px;"  src="https://file.hstatic.net/200000491705/article/1_f6b5e00f1bd4457298c72276b55c582e.jpeg" alt="..." />
                            </div>
                        </div>

                        <div style="display: flex;flex-direction: column;padding-right:50px;text-align: center;">
                          <div ><h2>Đào tạo tốt nhất</h2></div>
                          <div> <img class="img-fluid" style="width: 350px;height: 260px;margin-top: 15px;"  src="https://www.bodyfitcoach.vn/uploads/category/dao-tao-pt-gym_1631788462.jpg" alt="..." />
                          </div>
                      </div>

                      <div style="display: flex;flex-direction: column;text-align: center;">
                        <div ><h2>Xây dựng body hoàn hảo</h2></div>
                        <div> <img class="img-fluid" style="width: 350px;height: 260px;margin-top: 15px;"  src="https://buffit.vn/wp-content/uploads/2021/02/B%C3%AD-quy%E1%BA%BFt-s%E1%BB%9F-h%E1%BB%AFu-body-ho%C3%A0n-h%E1%BA%A3o-v%E1%BB%9Bi-b%E1%BB%99-d%C3%A2y-ng%C5%A9-s%E1%BA%AFc-t%E1%BA%ADp-gym-2.jpg" alt="..." />
                        </div>
                    </div>
                  </div>
                  <div style="display: flex;flex-direction:row;">

                    <div  style="display: flex;flex-direction: column;padding-right:50px;text-align: center;">
                        <div ><h2>Hệ thống dụng cụ</h2></div>
                        <div> <img class="img-fluid" style="width: 350px;height: 260px;margin-top: 15px;"  src="https://www.thethaodaiviet.vn/upload/dung-cu-tap-gym-nao-phu-hop-cho-tat-ca-moi-nguoi.jpg?v=1.0.0" alt="..." />
                        </div>
                    </div>

                    <div  style="display: flex;flex-direction: column;padding-right:50px;text-align: center;">
                      <div ><h2>Không gian phòng</h2></div>
                      <div> <img class="img-fluid" style="width: 350px;height: 260px;margin-top: 15px;"  src="https://kientrucnamcuong.com/admin/webroot/upload/image/images/noithat/noi-that-hien-dai/phong-gym-123/phong-gym-123/phong-gym-123-07.jpg" alt="..." />
                      </div>
                  </div>

                  <div style="display: flex;flex-direction: column;">
                    <div ><h2>Nhân viên chất lượng</h2></div>
                    <div> <img class="img-fluid" style="width: 350px;height: 260px;text-align: center;margin-top: 15px;"  src="https://gymdesign.vn/wp-content/uploads/2021/10/khi-nao-phong-gym-mo-cua-tro-lai-5.jpg" alt="..." />
                    </div>
                </div>
              </div>



            </div>


      </section>
      <!-- discount Section -->
      <section class="section discount">
        <div class="overlay">
          <video class="video">
            <source src="{{ asset('admin/images/FITNESS ‐ Được tạo bằng Clipchamp.mp4') }}" type="video/mp4" />
            <source src="{{ asset('admin/images/hero-2.webm') }}" type="video/webm" />
          </video>
        </div>
        <div class="content">
          <h1>
          FITNESS<br />
           Title description, Dec 7, 2023
          </h1>
          <a href="#" class="btn">Explore the Gym</a>
          <span class="video-control d-flex"><i class="bx bx-play"></i></span>
        </div>
      </section>

      <!-- Trip Section -->
      <section class="section trip" id="trips">
        <div class="title">
          <h1>
            Một số <br />
            hình ảnh tập
          </h1>

        </div>

        <div class="row container">
          <div class="swiper-container slider-3">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <img src="{{ asset('admin/images/Cởi-trần-tập-gym.jpg') }}" alt="hero image" />
              </div>
              <div class="swiper-slide">
                <img src="{{ asset('admin/images/chup-anh-phong-gym-14.jpg') }}" alt="" />
              </div>
              <div class="swiper-slide">
                <img src="{{ asset('admin/images/huong-dan-tap-gym-cho-nam.jpg') }}" alt="" />
              </div>
              <div class="swiper-slide">
                <img src="{{ asset('admin/images/bai-tap-gym-elle-man-featured-image.jpg') }}" alt="" />
              </div>
              <div class="swiper-slide">
                <img src="{{ asset('admin/images/imagegym.jpg') }}" alt="" />
              </div>
              <div class="swiper-slide">
                <img src="{{ asset('admin/images/keotagym.jpg') }}" alt="" />
              </div>
              <div class="swiper-slide">
                <img src="{{ asset('admin/images/taptaygym.jpg') }}" alt="" />
              </div>
            </div>
          </div>
          <div class="custom-next d-flex">
            <i class="bx bx-chevron-right swiper-icon"></i>
          </div>
          <div class="custom-prev d-flex">
            <i class="bx bx-chevron-left swiper-icon"></i>
          </div>
          <div class="custom-pagination d-flex"></div>
        </div>
        <div class="explore">
          <a href="#" class="btn">Explore All</a>
        </div>
      </section>

      <!-- More Section -->
      <section class="section more">
        <div class="row container">
          <div class="col">
            <div class="title">
              <h1>
                Đa dạng các thiết bị <br />
                dành cho bạn
              </h1>

            </div>
            <div class="tours">
              <div class="box">
                <img src="{{ asset('admin/images/Tạ.jpg') }}" alt="" />
                <h3>Tạ</h3>
              </div>
              <div class="box">
                <img src="{{ asset('admin/images/Máy.jpg') }}" alt="" />
                <h3>Máy</h3>

              </div>
            </div>
            <a href="#" class="btn">Khám phá nhiều hơn về Gym</a>
          </div>
          <div class="col">
            <img src="{{ asset('admin/images/tạ+máy.jpg') }}" alt="" />
          </div>
        </div>
      </section>

      <!-- NewsLetter Section -->
      <section class="section newsletter">
        <div style="margin-top: -90px;" class="row container">
          <div class="col">
            <h2>Gym sẽ mang lại cho bạn một cảm giác tuyệt vời!</h2>

          </div>
          <div class="col"><img style="height: 250px;" src="{{ asset('admin/images/nenphong3.jpg') }}"></div>
        </div>
      </section>

      <!-- Contact Section -->
      <section class="section contact" id="contact">
        <div class="title">
          <h1>ĐỊA ĐIỂM PHÒNG GYM
          </h1>

        </div>

        <div class="location container">
          <iframe
           src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3835.733396391822!2d108.24978007500276!3d15.975293084690728!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108997dc971f%3A0x1295cb3d313469c9!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiB2w6AgVHJ1eeG7gW4gdGjDtG5nIFZp4buHdCAtIEjDoG4!5e0!3m2!1svi!2s!4v1686388985714!5m2!1svi!2s"
            width="600"
            height="550"
            style="border: 0"
            allowfullscreen=""
            loading="lazy"
          ></iframe>
        </div>
      </section>
    </main>
<!-- Footer -->
<footer class="footer">
      <div class="row container1">

      <div class="col" style="margin-left:300px">

                    <h3>Contact Info</h3>
                    <ul style="margin-left:-50px">
                        <li><a href="#">470 Trần Đại Nghĩa</a></li>
                        <li><a href="#">Đà Nẵng, Việt Nam 2023</a></li>
                        <li><a href="#">+84 367462316</a></li>
                        <li><a href="#">xuanductran71@gmail.com.vn</a></li>
                    </ul>




        </div>

        <div class="col">
        <h3>Connect</h3>
                    <div class="social " >
                        <a href="#"><i class='bx bxl-facebook'></i></a>
                        <a href="#"><i class='bx bxl-instagram' ></i></a>
                        <a href="#"><i class='bx bxl-twitter' ></i></a>
                        <a href="#"><i class='bx bxl-linkedin' ></i></a>
                    </div>
        </div>

        <div class="col">
          <img src="{{ asset('admin/images/nenphong1.jpg') }}" alt="" />
          <img src="{{ asset('admin/images/nenphong2.jpg') }}" alt="" />
          <img src="{{ asset('admin/images/nenphong3.jpg') }}" alt="" />
          <img src="{{ asset('admin/images/nenphong4.jpg') }}" alt="" />
        </div>
      </div>
  </footer>

    <!-- ======== SwiperJS ======= -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.7.5/swiper-bundle.min.js"></script>
    <!-- ======== SCROLL REVEAL ======= -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/4.0.9/scrollreveal.min.js"></script>
    <!-- ======== SliderJS ======= -->
    <script src="{{ asset('admin/js/slider.js') }}"></script>
    <!-- ======== IndexJS ======= -->
    <script src="{{ asset('admin/js/index.js') }}"></script>
  </body>
</html>
