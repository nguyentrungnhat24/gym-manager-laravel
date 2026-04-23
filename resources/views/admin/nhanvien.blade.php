@extends('admin.layouts.app')
@section('title', 'Quản lý nhân viên')
@section('content')

<!-- Modal Thêm Nhân Viên -->
<div id="id01" class="modal">
  <form class="modal-content animate nv-form-modal" action="{{ route('admin.nhanvien.add') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container" style="padding:0;">
      <h3 class="mb-4 nv-form-modal-title">Thông tin cá nhân</h3>
      <div class="nv-form-group">
        <label class="nv-form-label">Tên nhân viên</label>
        <input type="text" name="tennv" value="{{ old('tennv') }}" required class="nv-form-input">
        @error('tennv')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Hình ảnh</label>
        <input type="file" name="image" required class="nv-form-input">
        @error('image')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Số điện thoại</label>
        <input type="number" name="sodt" value="{{ old('sodt') }}" required class="nv-form-input">
        @error('sodt')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Email</label>
        <input type="text" name="email" value="{{ old('email') }}" required id="txtEmail" aria-describedby="msgEmail" class="nv-form-input">
        <small id="msgEmail" class="text-muted" style="color:red !important;display:none"></small>
        @error('email')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Địa chỉ</label>
        <input type="text" name="diachi" value="{{ old('diachi') }}" required class="nv-form-input">
        @error('diachi')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Username</label>
        <input type="text" name="username" value="{{ old('username') }}" required class="nv-form-input">
        @error('username')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Password</label>
        <input type="password" name="password" required class="nv-form-input">
        @error('password')<div class="text-danger">{{ $message }}</div>@enderror
      </div>

      <input type="submit" name="themmoi" class="btn btn-success w-100 mt-2 nv-btn-modal" value="Đăng ký" onclick="return ktEmail('txtEmail','msgEmail','Sai định dạng Email !')">
      @if(session('success'))
      <div class="alert alert-success mt-2">{{ session('success') }}</div>
      @endif
      @if($errors->any())
      <div class="alert alert-danger mt-2">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="btn btn-danger w-100 mt-2 nv-btn-modal">Hủy</button>
    </div>
  </form>
</div>

<!-- Modal Update Nhân Viên (ẩn/hiện bằng id02) -->
<div id="id02" class="modal" style="display:none;">
  <form id="updateForm" class="modal-content animate nv-form-modal" action="" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container" style="padding:0;">
      @if(session('nhanvien_update_id'))
        <input type="hidden" id="update_id" value="{{ session('nhanvien_update_id') }}">
      @endif
      @if($errors->any() && session('nhanvien_update_error'))
        <div class="alert alert-danger mt-2">
          <ul class="mb-0">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <h3 class="mb-4 nv-form-modal-title">Cập nhật nhân viên</h3>
      <div class="nv-form-group">
        <label class="nv-form-label">Tên nhân viên</label>
        <input type="text" name="tennv" id="update-tennv" required class="nv-form-input">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Hình ảnh</label>
        <input type="file" name="image" class="nv-form-input">
        <img id="update-image-preview" src="" style="width:60px; margin-top:8px; border-radius:8px; display:none;">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Số điện thoại</label>
        <input type="number" name="sodt" id="update-sodt" required class="nv-form-input">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Email</label>
        <input type="text" name="email" id="update-email" required class="nv-form-input">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Địa chỉ</label>
        <input type="text" name="diachi" id="update-diachi" required class="nv-form-input">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Username</label>
        <input type="text" name="username" id="update-username" required class="nv-form-input">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Password (để trống nếu không đổi)</label>
        <input type="password" name="password" id="update-password" class="nv-form-input">
      </div>

      <input type="submit" class="btn btn-success w-100 mt-2 nv-btn-modal" value="Cập nhật">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="btn btn-danger w-100 mt-2 nv-btn-modal">Hủy</button>
    </div>
  </form>
</div>

<script>
  $(document).ready(function() {
    $("#hide").click(function() {
      $(".attendance").hide();
    });
    $("#show").click(function() {
      $(".attendance").show();
    });
  });

  function ktEmail(idTag, idMsg, msg) {
    var idTag = document.getElementById(idTag);
    var idMsg = document.getElementById(idMsg);
    var valueInput = idTag.value;
    var redExr = /^([\w-\.]+)@([\w-]+\.)+[\w-]{2,4}$/;
    if (!redExr.test(valueInput)) {
      idMsg.style.display = "block";
      idMsg.innerHTML = msg;
      return false;
    } else {
      idMsg.style.display = "none";
      return true;
    }
  }

  function openUpdateModal() {
    document.getElementById('id02').style.display = 'block';
  }
</script>

<div class="container section">
  <div class="title">
    <h1 style="font-size:3.2rem; margin-bottom:2.5rem; text-shadow: 2px 2px 4px #333;">DANH SÁCH NHÂN VIÊN</h1>
  </div>
  <div class="d-flex flex-wrap" style="gap: 2.5rem; justify-content: flex-start;">
    @foreach($nhanviens as $nv)
    <div class="card" style="flex: 0 0 23%; max-width: 23%; min-width: 260px; min-height: 410px; box-shadow: 0 8px 18px rgba(0,0,0,0.25); margin-bottom: 2.5rem; border-radius: 18px; padding: 0; background: linear-gradient(160deg, #a8edea 0%, #005c97 100%); position:relative; display:flex; flex-direction:column; align-items:center;">
      <img class="avatar" style="width: 120px; height: 120px; border-radius: 50%; margin-bottom: 10px; object-fit: cover; border: 4px solid #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.15); background: #fff;" src="{{ asset($nv['image']) }}">
      <div style="flex:1; width:100%; display:flex; flex-direction:column; align-items:center; justify-content:center;">
        <h3 class="text-center" style="font-size:1.85rem; font-weight:700; letter-spacing:1px; margin-top:10px; text-transform:uppercase; color:#0f2341;">{{ $nv['tennv'] }}</h3>

        <div class="d-flex justify-content-center mb-2" style="gap:1.1rem;">
          <span style="background:#fff; color:#005c97; font-weight:600; border-radius:14px; padding:6px 20px; font-size:1.25rem; box-shadow:0 1px 3px #bbb;">100%</span>
          <span style="background:#fff; color:#005c97; font-weight:600; border-radius:14px; padding:6px 20px; font-size:1.25rem; box-shadow:0 1px 3px #bbb;">90%</span>
        </div>
        <div class="d-flex justify-content-center mb-2" style="gap:3rem; font-size:1.18rem; color:#222;">
          <span>Nhiệt tình</span>
          <span>Kinh nghiệm</span>
        </div>
      </div>
      <a class="btn w-100 mt-auto mb-3" style="background: linear-gradient(90deg, #ffe259 0%, #ffa751 100%); color:#222; font-size:1.45rem; font-weight:700; border-radius:10px; box-shadow:0 4px 10px #005c97; max-width:90%; margin:0 auto; display:block; padding:12px 0;"
        href="javascript:void(0);"
        onclick="showUpdateModal(this)"
        data-id="{{ $nv['id'] }}"
        data-tennv="{{ $nv['tennv'] }}"
        data-sodt="{{ $nv['sodt'] }}"
        data-email="{{ $nv['email'] }}"
        data-diachi="{{ $nv['diachi'] }}"
        data-username="{{ $nv['username'] }}"

        data-image="{{ asset($nv['image']) }}">
        <i class="fas fa-edit"></i></a>

    </div>
    @endforeach
  </div>
  <!-- <button id="show" class="btn btn-info mb-2" style="font-size:1.1rem; padding:8px 24px;">XEM CHI TIẾT!</button> -->
  <section class="attendance">
    <div class="attendance-list" style="max-width:1100px; margin:0 auto; background:#fff; border-radius:18px; box-shadow:0 8px 24px rgba(0,0,0,0.13); padding:32px 24px 32px 24px;">
      <h2 class="title" style="font-size:2.2rem; text-shadow:2px 2px 4px #333; margin-bottom:24px;">THÔNG TIN CÁ NHÂN:</h2>
      <div class="d-flex flex-row mb-3" style="gap: 1.2rem;">
        <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-success" style="font-size:1.1rem; padding:10px 24px; border-radius:8px;"><i class="fa fa-plus-square"></i> Thêm</button>
        <button class="btn btn-success" style="font-size:1.1rem; padding:10px 24px; border-radius:8px;">Xuất file</button>
      </div>
      <table class="table table-bordered table-hover" style="font-size:1.15rem; border-radius:14px; overflow:hidden; background:#fff;">
        <thead style="background:#219150; color:#fff;">
          <tr style="height:56px;">
            <th style="font-size:1.7rem; text-align:center;">ID</th>
            <th style="font-size:1.7rem; text-align:center;">Họ và tên</th>
            <th style="font-size:1.7rem; text-align:center;">Ảnh</th>
            <th style="font-size:1.7rem; text-align:center;">Số điện thoại</th>
            <th style="font-size:1.7rem; text-align:center;">Email</th>
            <th style="font-size:1.7rem; text-align:center;">Địa chỉ</th>

            <th style="text-align:center;"></th>
            <th style="text-align:center;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($nhanviens as $i => $nv)
          <tr style="height:72px; vertical-align:middle;">
            <td style="text-align:center; font-size:1.6rem;">{{ $i+1 }}</td>
            <td style="text-align:center; font-weight:500; font-size:1.6rem;">{{ $nv['tennv'] }}</td>
            <td style="text-align:center;">
              <img class="avatar" style="width:60px; height:60px; border-radius:50%; object-fit:cover; display:inline-block; border:2px solid #eee; background:#fff;" src="{{ asset($nv['image']) }}">
            </td>
            <td style="text-align:center; font-size:1.6rem;">{{ $nv['sodt'] }}</td>
            <td style="text-align:center; font-size:1.6rem;">{{ $nv['email'] }}</td>
            <td style="text-align:center; font-size:1.6rem;">{{ $nv['diachi'] }}</td>

            <td style="text-align:center;">
              <a class="btn"
                style="background:#ffc107 ; color:#fff;
                                   font-size:1.3rem;
                                   border-radius:50%; 
                                   padding:10px 14px; 
                                   box-shadow:0 2px 6px #bbb; 
                                   display:inline-flex; 
                                   align-items:center; 
                                   justify-content:center;"
                href="javascript:void(0);"
                onclick="showUpdateModal(this)"
                data-id="{{ $nv['id'] }}"
                data-tennv="{{ $nv['tennv'] }}"
                data-sodt="{{ $nv['sodt'] }}"
                data-email="{{ $nv['email'] }}"
                data-diachi="{{ $nv['diachi'] }}"
                data-username="{{ $nv['username'] }}"

                data-role="{{ $nv['role'] ?? '' }}"
                data-image="{{ asset($nv['image']) }}">
                <i class="fas fa-edit"></i>
              </a>
            </td>
            <td style="text-align:center;">
              <a class="btn" style="background:#e74c3c; color:#fff; font-size:1.3rem; border-radius:50%; padding:10px 14px; box-shadow:0 2px 6px #bbb; display:inline-flex; align-items:center; justify-content:center;" href="{{ route('admin.nhanvien.delete', ['id' => $nv['id']]) }}"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </section>
  <!-- <button id="hide" class="btn btn-info mt-2" style="font-size:1.1rem; padding:8px 24px;">RÚT GỌN!</button> -->
</div>

@endsection

<script>
  function showUpdateModal(btn) {
    var id = btn.getAttribute('data-id');
    var tennv = btn.getAttribute('data-tennv');
    var sodt = btn.getAttribute('data-sodt');
    var email = btn.getAttribute('data-email');
    var diachi = btn.getAttribute('data-diachi');
    var image = btn.getAttribute('data-image');
    var username = btn.getAttribute('data-username');

    document.getElementById('update-tennv').value = tennv;
    document.getElementById('update-sodt').value = sodt;
    document.getElementById('update-email').value = email;
    document.getElementById('update-diachi').value = diachi;
    document.getElementById('update-username').value = username;

    var imgPreview = document.getElementById('update-image-preview');
    if (image) {
      imgPreview.src = image;
      imgPreview.style.display = 'inline-block';
    } else {
      imgPreview.style.display = 'none';
    }

    var form = document.getElementById('updateForm');
    form.action = '/admin/nhanvien/update/' + id;
    document.getElementById('id02').style.display = 'block';
  }

  // Tự động mở modal cập nhật nếu có lỗi
  window.onload = function() {
    var updateId = document.getElementById('update_id');
    if (updateId) {
      document.getElementById('id02').style.display = 'block';
    }
  }
</script>