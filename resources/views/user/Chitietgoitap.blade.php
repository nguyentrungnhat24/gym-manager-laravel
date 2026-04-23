@extends('user.layouts.app')

@section('title', 'Chi tiết lớp tập')

@section('content')
<div class="site-section" id="schedule-section">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-8 section-heading">
        <span class="subheading">Fitness Class</span>
        <h2 class="heading mb-3">Chi tiết lớp tập</h2>
      </div>
    </div>

    @if(isset($class))
    <div class="container">
      <div class="row g-4 justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="package-item">
            <div class="overflow-hidden d-flex justify-content-center align-items-center" style="height:400px;">
              <img class="img-fluid rounded" src="{{ asset('user/images/img_1.jpg') }}" alt="{{ $class->tenloptap }}" style="max-height:100%; max-width:100%; object-fit:cover;">
            </div>
            <div class="d-flex border-bottom">
              <small class="flex-fill text-center border-end py-2">
                <i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $class->duration_days }} ngày
              </small>
              
              <small class="flex-fill text-center py-2">
                <i class="fa fa-user text-primary me-2"></i> 1 Người
              </small>
            </div>
            <div class="text-center p-4">
              <h3 class="mb-0">{{ number_format($class->gia, 0, ',', '.') }} VNĐ</h3>
              <div class="mb-3"></div>
              <p>{{ $class->tenloptap }}</p>
              <div class="d-flex justify-content-center mb-2">
                <form action="{{ route('user.cart.add') }}" method="POST">
                  @csrf
                  <input type="hidden" name="category_id" value="{{ $class->id}}">
                  <input type="hidden" name="soluong" value="1">
                  <input type="hidden" name="price" value="{{ $class->gia }}">
                  <button type="submit" class="btn btn-success" name="themvaogio">
                    <i class="fa fa-shopping-cart"></i> Thêm vào giỏ
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif

    <!-- Lịch tập Section -->
    <div class="site-section mt-5" id="schedule-section">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-8 section-heading">
            <span class="subheading">Fitness Schedule</span>
            <h2 class="heading mb-3">Lịch tập</h2>
          </div>
        </div>

        @php
          // Mảng ngày bằng tiếng Anh để khớp với dữ liệu SQL
          $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
        @endphp

        <div class="row">
          <div class="col-12">
            <ul class="nav days d-flex" role="tablist">
              @foreach($days as $index => $day)
                @php
                  $tabId = strtolower($day);
                @endphp
                <li class="nav-item">
                  <a class="nav-link {{ $index === 0 ? 'active' : '' }}" id="{{ $tabId }}-tab" data-toggle="tab" href="#{{ $tabId }}" role="tab" aria-controls="{{ $tabId }}" aria-selected="{{ $index === 0 ? 'true' : 'false' }}">{{ $day }}</a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>

        <div class="tab-content bg-light">
          @foreach($days as $index => $day)
            @php
              $tabId = strtolower($day);
              $limit = 2;
              $pageParam = 'page_' . $tabId;
              $page = (int) request()->query($pageParam, 1);

              // Lọc lịch tập theo ngày
              $dayItems = $lichTaps->where('day_of_week', $day)->values();
              $total = $dayItems->count();
              $totalPages = (int) ceil(max($total, 1) / $limit);
              $itemsToShow = $dayItems->slice(($page - 1) * $limit, $limit);
            @endphp

            <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="{{ $tabId }}" role="tabpanel" aria-labelledby="{{ $tabId }}-tab">
              <div class="row">
                @forelse($itemsToShow as $item)
                  <div class="col-lg-6">
                    <div class="class-item d-flex align-items-center">
                      <a href="#" class="class-item-thumbnail">
                        <img src="{{ asset('user/images/img_1.jpg') }}" alt="Class image">
                      </a>
                      <div class="class-item-text">
                        <span>{{ $item->start_time }} - {{ $item->end_time }}</span>
                        <h2><a href="#">{{ $item->schedule_name }}</a></h2>
                        <span>Phòng tập: </span>
                        <span>{{ $item->room }}</span>
                      </div>
                    </div>
                  </div>
                @empty
                  <div class="col-12 text-center py-4">Không có lịch tập cho ngày này.</div>
                @endforelse
              </div>

              @if($totalPages > 1)
                <ul class="pagination">
                  @for($j = 1; $j <= $totalPages; $j++)
                    <li class="page-item {{ $j === $page ? 'active' : '' }}">
                      <a class="page-link" href="{{ route('user.class.detail', array_merge(request()->query(), ['id' => $class->id ?? 0, $pageParam => $j])) }}">{{ $j }}</a>
                    </li>
                  @endfor
                </ul>
              @endif
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <!-- Bình luận Section -->
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h2>Bình luận lớp tập</h2>
            </div>
            <div class="card-body">
              <form id="commentForm" method="POST" action="{{ route('user.comment.add') }}">
                @csrf
                <input type="hidden" id="idlt" name="idlt" value="{{ $class->id ?? '' }}">
                <div class="form-group mb-3">
                  <label for="name">Tên</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên của bạn" required>
                </div>
                <div class="form-group mb-3">
                  <label for="title">Tiêu đề</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề của bình luận" required>
                </div>
                <div class="form-group mb-3">
                  <label for="comment">Nội dung</label>
                  <textarea class="form-control" id="comment" name="comment" rows="5" placeholder="Nhập nội dung bình luận" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" id="btnGui">
                  <i class="fa fa-paper-plane"></i> Gửi bình luận
                </button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h2>Danh sách bình luận</h2>
            </div>
            <div class="card-body" id="dsbinhluan">
              @if(isset($comments) && $comments->count() > 0)
                @foreach($comments as $comment)
                  <div class="comment-item mb-3 p-3 border rounded">
                    <div class="d-flex">
                      <div class="flex-shrink-0">
                        <img src="https://www.gravatar.com/avatar/?d=mm&f=y&s=50" alt="Ảnh đại diện" class="rounded-circle" width="50">
                      </div>
                      <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1">{{ $comment->name }}</h6>
                        <p class="text-muted mb-1"><strong>Tiêu đề:</strong> {{ $comment->title }}</p>
                        <p class="mb-0">{{ $comment->comment }}</p>
                        <small class="text-muted">ID: {{ $comment->id }}</small>
                      </div>
                    </div>
                  </div>
                @endforeach
                
                @if($comments->hasPages())
                  <div class="d-flex justify-content-center">
                    {{ $comments->links() }}
                  </div>
                @endif
              @else
                <p class="text-muted text-center">Chưa có bình luận nào.</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
  // Comment form submission
  $('#commentForm').on('submit', function(e) {
    e.preventDefault();
    
    var formData = {
      idlt: $('#idlt').val(),
      name: $('#name').val(),
      title: $('#title').val(),
      comment: $('#comment').val(),
      _token: $('input[name="_token"]').val()
    };

    $.ajax({
      type: 'POST',
      url: '{{ route("user.comment.add") }}',
      data: formData,
      success: function(response) {
        if (response.success) {
          // Reload comments section
          $('#dsbinhluan').load(window.location.href + ' #dsbinhluan');
          
          // Reset form
          $('#name').val('');
          $('#title').val('');
          $('#comment').val('');
          
          // Show success message
          alert('Bình luận đã được gửi thành công!');
        } else {
          alert('Có lỗi xảy ra khi gửi bình luận.');
        }
      },
      error: function(xhr, status, error) {
        console.error(error);
        alert('Có lỗi xảy ra khi gửi bình luận.');
      }
    });
  });

  // Auto-hide alerts
  setTimeout(function() {
    $('.alert').fadeOut('slow');
  }, 5000);
});
</script>
@endpush