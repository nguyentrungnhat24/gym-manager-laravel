@extends('admin.layouts.app')
@section('title', 'Quản lý PT')
@section('content')
<!-- Modal Thêm PT -->
<div id="id01" class="modal">
  <form class="modal-content animate nv-form-modal" action="{{ route('admin.pt.add') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container" style="padding:0;">
      <h3 class="mb-4 nv-form-modal-title">Thông tin PT</h3>
      <div class="nv-form-group">
        <label class="nv-form-label">Tên PT</label>
        <input type="text" name="tenpt" value="{{ old('tenpt') }}" required class="nv-form-input">
        @error('tenpt')<div class="text-danger">{{ $message }}</div>@enderror
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
        <label class="nv-form-label">Vai trò</label>
        <input type="text" name="vaitro" value="{{ old('vaitro') }}" required class="nv-form-input">
        @error('vaitro')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Quan điểm</label>
        <textarea name="quandiem" value="{{ old('quandiem') }}" required class="nv-form-input" rows="3"></textarea>
        @error('quandiem')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Danh mục đào tạo</label>
        <select name="training_category_id" required class="nv-form-input">
          <option value="">Chọn danh mục</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
          @endforeach
        </select>
        @error('training_category_id')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <input type="submit" name="themmoi" class="btn btn-success w-100 mt-2 nv-btn-modal" value="Thêm PT" onclick="return ktEmail('txtEmail','msgEmail','Sai định dạng Email !')">
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
<!-- Modal Update PT (ẩn/hiện bằng id02) -->
<div id="id02" class="modal" style="display:none;">
  <form id="updateForm" class="modal-content animate nv-form-modal" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container" style="padding:0;">
      @if(session('pt_update_id'))
        <input type="hidden" id="update_id" value="{{ session('pt_update_id') }}">
      @endif
      @if($errors->any() && session('pt_update_error'))
        <div class="alert alert-danger mt-2">
          <ul class="mb-0">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <h3 class="mb-4 nv-form-modal-title">Cập nhật PT</h3>
      <div class="nv-form-group">
        <label class="nv-form-label">Tên PT</label>
        <input type="text" name="full_name" id="update-tenpt" required class="nv-form-input">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Hình ảnh</label>
        <input type="file" name="image" class="nv-form-input">
        <img id="update-image-preview" src="" style="width:60px; margin-top:8px; border-radius:8px; display:none;">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Số điện thoại</label>
        <input type="number" name="phone_number" id="update-sodt" required class="nv-form-input">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Email</label>
        <input type="text" name="email" id="update-email" required class="nv-form-input">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Vai trò</label>
        <input type="text" name="vaitro" id="update-vaitro" required class="nv-form-input">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Quan điểm</label>
        <textarea name="quandiem" id="update-quandiem" required class="nv-form-input" rows="3"></textarea>
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Danh mục đào tạo</label>
        <select name="training_category_id" id="update-training-category" required class="nv-form-input">
          <option value="">Chọn danh mục</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
          @endforeach
        </select>
      </div>

      <input type="submit" class="btn btn-success w-100 mt-2 nv-btn-modal" value="Cập nhật">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="btn btn-danger w-100 mt-2 nv-btn-modal">Hủy</button>
    </div>
  </form>
</div>
<div class="container section">
    <section class="attendance">
        <div class="attendance-list" style="max-width:1100px; margin:0 auto; background:#fff; border-radius:18px; box-shadow:0 8px 24px rgba(0,0,0,0.13); padding:32px 24px 32px 24px;">
            <h2 class="title" style="font-size:2.2rem; text-shadow:2px 2px 4px #333; margin-bottom:24px;">THÔNG TIN PT:</h2>
            <div class="d-flex flex-row mb-3" style="gap: 1.2rem;">
                <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-success" style="font-size:1.1rem; padding:10px 24px; border-radius:8px;"><i class="fa fa-plus-square"></i> Thêm</button>
                <a href="{{ route('admin.pt.export') }}" class="btn btn-success" style="font-size:1.1rem; padding:10px 24px; border-radius:8px; text-decoration:none;"><i class="fa fa-download"></i> Xuất file</a>
            </div>
            <table class="table table-bordered table-hover" style="font-size:1.15rem; border-radius:14px; overflow:hidden; background:#fff;">
                <thead style="background:#219150; color:#fff;">
                    <tr style="height:56px;">
                        <th style="font-size:1.7rem; text-align:center;">ID</th>
                        <th style="font-size:1.7rem; text-align:center;">Tên PT</th>
                        <th style="font-size:1.7rem; text-align:center;">Ảnh</th>
                        <th style="font-size:1.7rem; text-align:center;">Số điện thoại</th>
                        <th style="font-size:1.7rem; text-align:center;">Email</th>
                        <th style="font-size:1.7rem; text-align:center;">Vai trò</th>
                        <th style="font-size:1.7rem; text-align:center;">Quan điểm</th>
                        <th style="text-align:center;">Sửa</th>
                        <th style="text-align:center;">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dspt as $i => $pt)
                        <tr style="height:72px; vertical-align:middle;">
                            <td style="text-align:center;">{{ $i+1 }}</td>
                            <td style="text-align:center; font-weight:500;">{{ $pt['tenpt'] }}</td>
                            <td style="text-align:center;">
                                <img class="avatar" style="width:60px; height:60px; border-radius:50%; object-fit:cover; display:inline-block; border:2px solid #eee; background:#fff;" src="{{ asset($pt['image']) }}">
                            </td>
                            <td style="text-align:center;">{{ $pt['sodt'] }}</td>
                            <td style="text-align:center;">{{ $pt['email'] }}</td>
                            <td style="text-align:center;">{{ $pt['vaitro'] }}</td>
                            <td style="text-align:center;">{{ $pt['quandiem'] }}</td>
                            <td style="text-align:center;">
                                <a class="btn" style="background:#ffc107 ; 
                                color:#fff; font-size:1.3rem; 
                                border-radius:50%; padding:10px 14px; 
                                box-shadow:0 2px 6px #bbb; display:inline-flex; 
                                align-items:center; justify-content:center;" 
                                href="javascript:void(0);" 
                                onclick="showUpdateModal(this)" 
                                data-id="{{ $pt['id'] }}"
                                data-tenpt="{{ $pt['tenpt'] }}" 
                                data-sodt="{{ $pt['sodt'] }}" 
                                data-email="{{ $pt['email'] }}" 
                                data-vaitro="{{ $pt['vaitro'] }}" 
                                data-quandiem="{{ $pt['quandiem'] }}" 
                                data-image="{{ asset($pt['image']) }}"
                                data-training-category-id="{{ $pt['training_category_id'] }}"> 
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td style="text-align:center;">
                                <a class="btn" style="background:#e74c3c; color:#fff; font-size:1.3rem; border-radius:50%; padding:10px 14px; box-shadow:0 2px 6px #bbb; display:inline-flex; align-items:center; justify-content:center;" href="{{ route('admin.pt.delete', ['id' => $pt['id']]) }}"><i class="fa fa-trash"></i></a>
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
  var id = btn.getAttribute('data-id');
  var tenpt = btn.getAttribute('data-tenpt');
  var sodt = btn.getAttribute('data-sodt');
  var email = btn.getAttribute('data-email');
  var vaitro = btn.getAttribute('data-vaitro');
  var quandiem = btn.getAttribute('data-quandiem');
  var image = btn.getAttribute('data-image');
  var trainingCategoryId = btn.getAttribute('data-training-category-id'); // Lấy danh mục

  document.getElementById('update-tenpt').value = tenpt;
  document.getElementById('update-sodt').value = sodt;
  document.getElementById('update-email').value = email;
  document.getElementById('update-vaitro').value = vaitro;
  document.getElementById('update-quandiem').value = quandiem;
  document.getElementById('update-training-category').value = trainingCategoryId; // Điền danh mục

  var imgPreview = document.getElementById('update-image-preview');
  if (image) {
    imgPreview.src = image;
    imgPreview.style.display = 'inline-block';
  } else {
    imgPreview.style.display = 'none';
  }

  var form = document.getElementById('updateForm');
  form.action = '/admin/pt/update/' + id;
  document.getElementById('id02').style.display = 'block';
}

// Tự động mở modal cập nhật nếu có lỗi
window.onload = function() {
  var updateId = document.getElementById('update_id');
  if (updateId) {
    document.getElementById('id02').style.display = 'block';
  }
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
