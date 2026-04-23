@extends('user.layouts.app')

@section('title', 'Liên hệ')

@section('content')
<div class="site-section bg-light contact-wrap" id="contact-section">
      <div class="container">
        
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-8  section-heading">
            <!-- <span class="subheading">Get In Touch</span> -->
            <h2 class="heading mb-3">Liên hệ với chúng tôi</h2>
            <!-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind
              texts.
            </p> -->
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-7">
            <form method="post" action="{{ route('user.contact.send') }}" data-aos="fade">
              @csrf
              <div class="form-group row">
                <div class="col-md-6 mb-3 mb-lg-0">
                  <input type="text" class="form-control" name="first_name" placeholder="Tên" required>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="last_name" placeholder="Họ và tên đệm" required>
                </div>
              </div>
    
              <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" class="form-control" name="phone" placeholder="Số điện thoại" required>
                </div>
              </div>
    
              <div class="form-group row">
                <div class="col-md-12">
                  <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <textarea class="form-control" name="message" cols="30" rows="10"
                    placeholder="Lời nhắn đến chúng tôi." required></textarea>
                </div>
              </div>
    
              <div class="form-group row">
                <div class="col-md-6">
                  <button type="submit" class="btn btn-primary py-3 px-5 btn-block">Gửi tin nhắn</button>
                </div>
              </div>
    
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="schedule-wrap2 clearfix">
      <div class="d-md-flex align-items-center">
        <div class="hours mr-md-4 mb-4 mb-lg-0">
          <strong class="d-block">Giờ hoạt động</strong>
          Mở cửa: 7:30 &mdash;
          Đóng cửa: 21:00
        </div>
    
      </div>
    </div> -->
@endsection