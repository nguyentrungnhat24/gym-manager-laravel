@extends('user.layouts.app')

@section('title', 'Lớp tập')

@section('content')


    <div class="site-section" id="schedule-section">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-8  section-heading">
            <!-- <span class="subheading">Fitness Class</span> -->
            <h2 class="heading mb-3">Lớp tập</h2>
            <p>Hãy nhớ rằng, mỗi buổi tập là một bước nhỏ nhưng chắc chắn trên con đường chinh phục mục tiêu sức khỏe và thể chất của bạn. Đừng so sánh mình với người khác; hãy so sánh bản thân bạn với phiên bản một ngày trước đó, và hãy là người đánh bại chính mình mỗi ngày.</p>
          </div>
        </div>

        <div class="container">
          <div class="row g-4 justify-content-center">
            @forelse($classes as $class)
              <div class="col-lg-4 col-md-6">
                <div class="package-item">
                  <div class="overflow-hidden">
                    <img class="img-fluid" src="{{ asset('user/images/img_1.jpg') }}" alt="">
                  </div>
                  <div class="d-flex border-bottom">
                    <small class="flex-fill text-center border-end py-2">
                      <i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $class->duration_days }} ngày
                    </small>
                    
                    <small class="flex-fill text-center py-2">|<i class="fa fa-user text-primary me-2"></i> 1 Người</small>
                  </div>
                  <div class="text-center p-4">
                    <h3 class="mb-0">{{ $class->gia }}</h3>
                    <div class="mb-3"></div>
                    <p>{{ $class->tenloptap }}</p>
                    <div class="d-flex justify-content-center mb-2">
                      <a href="{{ route('user.class.detail', ['id' => $class->id]) }}" class="btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>
                    </div>
                  </div>
                </div>
              </div>
            @empty
              <p>Không có lớp tập nào.</p>
            @endforelse
          </div>
        </div>







      </div>
@endsection