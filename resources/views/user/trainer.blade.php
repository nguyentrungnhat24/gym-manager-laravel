@extends('user.layouts.app')

@section('title', 'Huấn luyện viên')

@section('content')
<div class="site-section" id="trainer-section">
  <div class="container">
    <div class="row justify-content-center text-center mb-5" data-aos="fade-up">
      <div class="col-md-8 section-heading">
        <h2 class="heading mb-3">Huấn luyện viên</h2>
      </div>
    </div>

    <div class="row">
      @forelse($pts as $pt)
        @php
          $imageUrl = $pt->image ? asset($pt->image) : asset('user/images/img_1.jpg');
        @endphp
        <div class="col-lg-3 mb-4 mb-lg-0 col-md-6 text-center" data-aos="fade-up">
          <div class="person">
            <img src="{{ $imageUrl }}" alt="{{ $pt->tenpt }}" class="img-fluid">
            <h3>{{ $pt->tenpt }}</h3>
            <p class="position">Trainer</p>
            <p>{{ $pt->quandiem }}</p>
          </div>
        </div>
      @empty
        <div class="col-12 text-center py-4">Chưa có huấn luyện viên nào.</div>
      @endforelse
    </div>
  </div>
  </div>
@endsection


