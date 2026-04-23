@extends('admin.layouts.app')
@section('title', 'Quản lý Gói Tập')
@section('content')
<!-- Modal Thêm Gói Tập -->
<div id="id01" class="modal">
  <form class="modal-content animate nv-form-modal" action="{{ route('admin.goitap.add') }}" method="post">
    @csrf
    <div class="container" style="padding:0;">
      <h3 class="mb-4 nv-form-modal-title">Thông tin Gói Tập</h3>

      <div class="nv-form-group">
        <label class="nv-form-label">Tên lớp tập</label>
        <input type="text" name="tenloptap" value="{{ old('tenloptap') }}" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Giá</label>
        <input type="number" step="1" name="gia" value="{{ old('gia') }}" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Số lượng</label>
        <input type="number" step="1" min="1" name="soluong" value="{{ old('soluong', 1) }}" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Thời gian (ngày)</label>
        <input type="number" step="1" min="1" name="thoigian" value="{{ old('thoigian', 30) }}" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Tên khách hàng</label>
        <input type="text" name="tenkh" value="{{ old('tenkh') }}" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Địa chỉ</label>
        <input type="text" name="diachi" value="{{ old('diachi') }}" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Số điện thoại</label>
        <input type="text" name="sdt" value="{{ old('sdt') }}" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required class="nv-form-input">
      </div>

      <input type="hidden" name="themmoigoitap" value="1">

      <input type="submit" class="btn btn-success w-100 mt-2 nv-btn-modal" value="Thêm Gói Tập">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="btn btn-danger w-100 mt-2 nv-btn-modal">Hủy</button>
    </div>
  </form>
  </div>

<!-- Modal Cập nhật Gói Tập -->
<div id="id02" class="modal" style="display:none;">
  <form id="updateForm" class="modal-content animate nv-form-modal" method="post">
    @csrf
    @method('POST')
    <div class="container" style="padding:0;">
      <h3 class="mb-4 nv-form-modal-title">Cập nhật Gói Tập</h3>

      <div class="nv-form-group">
        <label class="nv-form-label">Tên lớp tập</label>
        <input type="text" name="tenloptap" id="update-tenloptap" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Giá</label>
        <input type="number" step="1" name="gia" id="update-gia" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Số lượng</label>
        <input type="number" step="1" min="1" name="soluong" id="update-soluong" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Thời gian (ngày)</label>
        <input type="number" step="1" min="1" name="thoigian" id="update-thoigian" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Tên khách hàng</label>
        <input type="text" name="tenkh" id="update-tenkh" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Địa chỉ</label>
        <input type="text" name="diachi" id="update-diachi" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Số điện thoại</label>
        <input type="text" name="sdt" id="update-sdt" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Email</label>
        <input type="email" name="email" id="update-email" required class="nv-form-input">
      </div>

      <input type="submit" class="btn btn-success w-100 mt-2 nv-btn-modal" value="Cập nhật">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="btn btn-danger w-100 mt-2 nv-btn-modal">Hủy</button>
    </div>
  </form>
</div>

<div class="container section">
  <section class="attendance">
    <div class="attendance-list" style="max-width:1100px; margin:0 auto; background:#fff; border-radius:18px; box-shadow:0 8px 24px rgba(0,0,0,0.13); padding:32px 24px 32px 24px;">
      <h2 class="title" style="font-size:2.2rem; text-shadow:2px 2px 4px #333; margin-bottom:24px;">THÔNG TIN GÓI TẬP:</h2>
      <div class="d-flex flex-row mb-3" style="gap: 1.2rem;">
        <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-success" style="font-size:1.1rem; padding:10px 24px; border-radius:8px;"><i class="fa fa-plus-square"></i> Thêm</button>
      </div>
      <table class="table table-bordered table-hover" style="font-size:1.15rem; border-radius:14px; overflow:hidden; background:#fff;">
        <thead style="background:#219150; color:#fff;">
          <tr style="height:56px;">
            <th style="font-size:1.1rem; text-align:center;">ID</th>
            <th style="font-size:1.1rem; text-align:center;">Tên lớp tập</th>
            <th style="font-size:1.1rem; text-align:center;">Giá</th>
            <th style="font-size:1.1rem; text-align:center;">Số lượng</th>
            <th style="font-size:1.1rem; text-align:center;">Thời gian</th>
            <th style="font-size:1.1rem; text-align:center;">Tên khách hàng</th>
            <th style="font-size:1.1rem; text-align:center;">Địa chỉ</th>
            <th style="font-size:1.1rem; text-align:center;">Số điện thoại</th>
            <th style="font-size:1.1rem; text-align:center;">Email</th>
            <th style="text-align:center;">Sửa</th>
            <th style="text-align:center;">Xóa</th>
            <th style="text-align:center;">Trạng thái</th>
            <th style="text-align:center;">Chuyển trạng thái</th>
          </tr>
        </thead>
        <tbody>
          @foreach($dsgoitap as $gt)
          <tr style="height:72px; vertical-align:middle;">
            <td style="text-align:center;">{{ $gt['id'] }}</td>
            <td style="text-align:center; font-weight:500;">{{ $gt['tenloptap'] }}</td>
            <td style="text-align:center;">{{ number_format($gt['gia']) }}</td>
            <td style="text-align:center;">{{ $gt['soluong'] }}</td>
            <td style="text-align:center;">{{ $gt['thoigian'] }}</td>
            <td style="text-align:center;">{{ $gt['tenkh'] }}</td>
            <td style="text-align:center;">{{ $gt['diachi'] }}</td>
            <td style="text-align:center;">{{ $gt['sdt'] }}</td>
            <td style="text-align:center;">{{ $gt['email'] }}</td>
            <td style="text-align:center;">
              <a class="btn" style="background:#ffc107 ; color:#fff; font-size:1.3rem; border-radius:50%; padding:10px 14px; box-shadow:0 2px 6px #bbb; display:inline-flex; align-items:center; justify-content:center;" href="javascript:void(0);" onclick="showUpdateModal(this)"
                 data-id="{{ $gt['id'] }}"
                 data-tenloptap="{{ $gt['tenloptap'] }}"
                 data-gia="{{ $gt['gia'] }}"
                 data-soluong="{{ $gt['soluong'] }}"
                 data-thoigian="{{ $gt['thoigian'] }}"
                 data-tenkh="{{ $gt['tenkh'] }}"
                 data-diachi="{{ $gt['diachi'] }}"
                 data-sdt="{{ $gt['sdt'] }}"
                 data-email="{{ $gt['email'] }}">
                <i class="fas fa-edit"></i>
              </a>
            </td>
            <td style="text-align:center;">
              <a class="btn" style="background:#e74c3c; color:#fff; font-size:1.3rem; border-radius:50%; padding:10px 14px; box-shadow:0 2px 6px #bbb; display:inline-flex; align-items:center; justify-content:center;" href="{{ route('admin.goitap.delete', ['id' => $gt['id']]) }}"><i class="fa fa-trash"></i></a>
            </td>
            <td style="text-align:center;">
              @if(($gt['state'] ?? 0) == 1)
                <span class="badge bg-success" style="font-size:1rem; padding:.6rem .8rem;">Đã thanh toán</span>
              @else
                <span class="badge bg-danger" style="font-size:1rem; padding:.6rem .8rem;">Duyệt thanh toán</span>
              @endif
            </td>
            <td style="text-align:center;">
              <a class="btn {{ ($gt['state'] ?? 0) == 1 ? 'btn-secondary' : 'btn-success' }}" style="font-size:1rem; padding:.45rem .9rem;" href="{{ route('admin.goitap.toggle', ['id' => $gt['id']]) }}">
                {{ ($gt['state'] ?? 0) == 1 ? 'Chuyển về chờ duyệt' : 'Duyệt ngay' }}
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </section>
</div>
@endsection

<script>
function showUpdateModal(btn) {
  const id = btn.getAttribute('data-id');
  document.getElementById('update-tenloptap').value = btn.getAttribute('data-tenloptap');
  document.getElementById('update-gia').value = btn.getAttribute('data-gia');
  document.getElementById('update-soluong').value = btn.getAttribute('data-soluong');
  document.getElementById('update-thoigian').value = btn.getAttribute('data-thoigian');
  document.getElementById('update-tenkh').value = btn.getAttribute('data-tenkh');
  document.getElementById('update-diachi').value = btn.getAttribute('data-diachi');
  document.getElementById('update-sdt').value = btn.getAttribute('data-sdt');
  document.getElementById('update-email').value = btn.getAttribute('data-email');

  var form = document.getElementById('updateForm');
  form.action = '/admin/goitap/update/' + id;
  document.getElementById('id02').style.display = 'block';
}
</script>


