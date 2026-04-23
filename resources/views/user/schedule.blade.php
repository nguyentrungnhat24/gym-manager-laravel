@extends('user.layouts.app')

@section('title', 'Lịch tập')

@section('content')
<div class="site-section" id="schedule-section">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-8 section-heading">
        <h2 class="heading mb-3">Lịch tập</h2>
      </div>
    </div>

    @php
      $days = [
        'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'
      ];
    @endphp

    <div class="row">
      <div class="col-12">
        <ul class="nav days d-flex" role="tablist">
          @foreach($days as $index => $day)
            @php
              $tabId = strtolower(str_replace(' ', '-', $day));
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
          $tabId = strtolower(str_replace(' ', '-', $day));
          $limit = 4;
          $pageParam = 'page_' . $tabId;
          $page = (int) request()->query($pageParam, 1);
          $dayItems = $lichTaps->where('NgayTap', $day)->values();
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
                    <span>{{ $item->BatDau }}-{{ $item->KetThuc }}</span>
                    <h2><a href="#">{{ $item->Ten }}</a></h2>
                    <span>Phòng tập: </span>
                    <span>{{ $item->phongtap }}</span>
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
                  <a class="page-link" href="{{ route('user.schedule', array_merge(request()->query(), [$pageParam => $j])) }}">{{ $j }}</a>
                </li>
              @endfor
            </ul>
          @endif
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection


