@extends('admin.layouts.app')
@section('title', 'Quản lý khách hàng')
@section('content')
<!-- Modal Thêm Khách Hàng -->
<div id="id01" class="modal">
  <form class="modal-content animate nv-form-modal" action="{{ route('admin.khachhang.add') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container" style="padding:0;">
      <h3 class="mb-4 nv-form-modal-title">Thông tin khách hàng</h3>
      <div class="nv-form-group">
        <label class="nv-form-label">Tên khách hàng</label>
        <input type="text" name="full_name" value="{{ old('full_name') }}" required class="nv-form-input">
        @error('full_name')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Hình ảnh</label>
        <input type="file" name="image" required class="nv-form-input">
        @error('image')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Số điện thoại</label>
        <input type="number" name="phone_number" value="{{ old('phone_number') }}" required class="nv-form-input">
        @error('phone_number')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Email</label>
        <input type="text" name="email" value="{{ old('email') }}" required id="txtEmail" aria-describedby="msgEmail" class="nv-form-input">
        <small id="msgEmail" class="text-muted" style="color:red !important;display:none"></small>
        @error('email')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Địa chỉ</label>
        <input type="text" name="address" value="{{ old('address') }}" required class="nv-form-input">
        @error('address')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Tên đăng nhập</label>
        <input type="text" name="username" value="{{ old('username') }}" required class="nv-form-input">
        @error('username')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Mật khẩu</label>
        <input type="password" name="password" required class="nv-form-input">
        @error('password')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <input type="submit" name="addKhachHang" class="btn btn-success w-100 mt-2 nv-btn-modal" value="Đăng ký" onclick="return ktEmail('txtEmail','msgEmail','Sai định dạng Email !')">
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
<!-- Modal Update Khách Hàng (ẩn/hiện bằng id02) -->
<div id="id02" class="modal" style="display:none;">
  <form id="updateForm" class="modal-content animate nv-form-modal" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="container" style="padding:0;">
      <h3 class="mb-4 nv-form-modal-title">Cập nhật khách hàng</h3>
      <div class="nv-form-group">
        <label class="nv-form-label">Tên khách hàng</label>
        <input type="text" name="full_name" id="update-name" required class="nv-form-input">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Hình ảnh</label>
        <input type="file" name="image" id="update-image" class="nv-form-input">
        <img id="update-image-preview" src="" style="width:60px; margin-top:8px; border-radius:8px; display:none;">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Số điện thoại</label>
        <input type="number" name="phone_number" id="update-phone_number" required class="nv-form-input">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Email</label>
        <input type="text" name="email" id="update-email" required class="nv-form-input">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Địa chỉ</label>
        <input type="text" name="address" id="update-address" required class="nv-form-input">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Tên đăng nhập</label>
        <input type="text" name="username" id="update-username" required class="nv-form-input">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Mật khẩu (để trống nếu không đổi)</label>
        <input type="password" name="password" id="update-password" class="nv-form-input">
      </div>

      <input type="submit" class="btn btn-success w-100 mt-2 nv-btn-modal" value="Cập nhật">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="btn btn-danger w-100 mt-2 nv-btn-modal">Hủy</button>
    </div>
  </form>
</div>
<div class="container section">
    <section class="attendance">
        <div class="attendance-list" style="max-width:1100px; margin:0 auto; background:#fff; border-radius:18px; box-shadow:0 8px 24px rgba(0,0,0,0.13); padding:32px 24px 32px 24px;">
            <h2 class="title" style="font-size:2.2rem; text-shadow:2px 2px 4px #333; margin-bottom:24px;">THÔNG TIN KHÁCH HÀNG:</h2>
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
                        
                        <th style="text-align:center;">Sửa</th>
                        <th style="text-align:center;">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dskh as $i => $kh)
                        @if(($kh['role_id'] ?? $kh['role'] ?? null) == 3)
                        <tr style="height:72px; vertical-align:middle;">
                            <td style="text-align:center;">{{ $i+1 }}</td>
                            <td style="text-align:center; font-weight:500;">{{ $kh['full_name'] ?? $kh['namee'] }}</td>
                            <td style="text-align:center;">
                                <img class="avatar" style="width:60px; height:60px; border-radius:50%; object-fit:cover; display:inline-block; border:2px solid #eee; background:#fff;" src="{{ asset($kh['image_path'] ?? $kh['image']) }}">
                            </td>
                            <td style="text-align:center;">{{ $kh['phone_number'] }}</td>
                            <td style="text-align:center;">{{ $kh['email'] }}</td>
                            <td style="text-align:center;">{{ $kh['address'] ?? $kh['addresss'] }}</td>
                          
                            <td style="text-align:center;">
                                <a class="btn" style="background:#ffc107 ; 
                                color:#fff; font-size:1.3rem; 
                                border-radius:50%; padding:10px 14px; 
                                box-shadow:0 2px 6px #bbb; display:inline-flex; 
                                align-items:center; justify-content:center;" 
                                href="javascript:void(0);" 
                                onclick="showUpdateModal(this)" 
                                data-id="{{ $kh['id'] }}"
                                data-name="{{ $kh['full_name'] }}" 
                                data-phone_number="{{ $kh['phone_number'] }}" 
                                data-email="{{ $kh['email'] }}" 
                                data-address="{{ $kh['address']  }}" 
                                data-image="{{ asset($kh['image_path'] ?? $kh['image'] ) }}"
                                data-username="{{ $kh['username'] }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td style="text-align:center;">
                                <a class="btn" style="background:#e74c3c; color:#fff; font-size:1.3rem; border-radius:50%; padding:10px 14px; box-shadow:0 2px 6px #bbb; display:inline-flex; align-items:center; justify-content:center;" href="{{ route('admin.khachhang.delete', ['id' => $kh['id']]) }}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
<script>
function showUpdateModal(btn) {
    var id = btn.getAttribute('data-id');
    var full_name = btn.getAttribute('data-name');
    var phone_number = btn.getAttribute('data-phone_number');
    var email = btn.getAttribute('data-email');
    var address = btn.getAttribute('data-address');
    var image = btn.getAttribute('data-image');
    var username = btn.getAttribute('data-username');
    // Fill vào form update
    document.getElementById('update-name').value = full_name;
    document.getElementById('update-phone_number').value = phone_number;
    document.getElementById('update-email').value = email;
    document.getElementById('update-address').value = address;
    document.getElementById('update-username').value = username;
    var imgPreview = document.getElementById('update-image-preview');
    if(image) {
        imgPreview.src = image;
        imgPreview.style.display = 'inline-block';
    } else {
        imgPreview.style.display = 'none';
    }
    // Set action cho form
    var form = document.getElementById('updateForm');
    form.action = '/admin/khachhang/update/' + id;
    // Hiện modal
    document.getElementById('id02').style.display = 'block';
}
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
</script>
