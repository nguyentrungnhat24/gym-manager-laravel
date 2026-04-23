@extends('admin.layouts.app')
@section('title', 'Quản lý Lịch Tập')
@section('content')
<!-- Modal Thêm Lịch Tập -->
<div id="id01" class="modal">
  <form class="modal-content animate nv-form-modal" action="{{ route('admin.lichtap.add') }}" method="post">
    @csrf
    <div class="container" style="padding:0;">
      <h3 class="mb-4 nv-form-modal-title">Thông tin Lịch Tập</h3>
      <div class="nv-form-group">
        <label class="nv-form-label">Tên lịch tập</label>
        <input type="text" name="Ten" value="{{ old('Ten') }}" required class="nv-form-input">
        @error('Ten')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Bắt đầu</label>
        <input type="time" name="BatDau" value="{{ old('BatDau') }}" required class="nv-form-input">
        @error('BatDau')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Kết thúc</label>
        <input type="time" name="KetThuc" value="{{ old('KetThuc') }}" required class="nv-form-input">
        @error('KetThuc')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Ngày tập</label>
        <select name="NgayTap" required class="nv-form-input">
          <option value="Thứ 2">Thứ 2</option>
          <option value="Thứ 3">Thứ 3</option>
          <option value="Thứ 4">Thứ 4</option>
          <option value="Thứ 5">Thứ 5</option>
          <option value="Thứ 6">Thứ 6</option>
          <option value="Thứ 7">Thứ 7</option>
          <option value="Chủ nhật">Chủ nhật</option>
        </select>
        @error('NgayTap')<div class="text-danger">{{ $message }}</div>@enderror
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Phòng tập</label>
        <input type="text" name="phongtap" value="{{ old('phongtap') }}" required class="nv-form-input">
        @error('phongtap')<div class="text-danger">{{ $message }}</div>@enderror
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
      <input type="submit" name="themmoilichtap" class="btn btn-success w-100 mt-2 nv-btn-modal" value="Thêm Lịch Tập">
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
<!-- Modal Update Lịch Tập (ẩn/hiện bằng id02) -->
<div id="id02" class="modal" style="display:none;">
  <form id="updateForm" class="modal-content animate nv-form-modal" method="post">
    @csrf
    @method('POST')
    <div class="container" style="padding:0;">
      <h3 class="mb-4 nv-form-modal-title">Cập nhật Lịch Tập</h3>
      <div class="nv-form-group">
        <label class="nv-form-label">Tên lịch tập</label>
        <input type="text" name="Ten" id="update-Ten" required class="nv-form-input">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Bắt đầu</label>
        <input type="time" name="BatDau" id="update-BatDau" required class="nv-form-input">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Kết thúc</label>
        <input type="time" name="KetThuc" id="update-KetThuc" required class="nv-form-input">
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Ngày tập</label>
        <select name="NgayTap" id="update-NgayTap" required class="nv-form-input">
          <option value="Thứ 2">Thứ 2</option>
          <option value="Thứ 3">Thứ 3</option>
          <option value="Thứ 4">Thứ 4</option>
          <option value="Thứ 5">Thứ 5</option>
          <option value="Thứ 6">Thứ 6</option>
          <option value="Thứ 7">Thứ 7</option>
          <option value="Chủ nhật">Chủ nhật</option>
        </select>
      </div>
      <div class="nv-form-group">
        <label class="nv-form-label">Phòng tập</label>
        <input type="text" name="phongtap" id="update-phongtap" required class="nv-form-input">
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
            <h2 class="title" style="font-size:2.2rem; text-shadow:2px 2px 4px #333; margin-bottom:24px;">THÔNG TIN LỊCH TẬP:</h2>
            <div class="d-flex flex-row mb-3" style="gap: 1.2rem;">
                <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-success" style="font-size:1.1rem; padding:10px 24px; border-radius:8px;"><i class="fa fa-plus-square"></i> Thêm</button>
            </div>
            <table class="table table-bordered table-hover" style="font-size:1.15rem; border-radius:14px; overflow:hidden; background:#fff;">
                <thead style="background:#219150; color:#fff;">
                    <tr style="height:56px;">
                        <th style="font-size:1.1rem; text-align:center;">ID</th>
                        <th style="font-size:1.1rem; text-align:center;">Tên lịch tập</th>
                        <th style="font-size:1.1rem; text-align:center;">Bắt đầu</th>
                        <th style="font-size:1.1rem; text-align:center;">Kết thúc</th>
                        <th style="font-size:1.1rem; text-align:center;">Ngày tập</th>
                        <th style="font-size:1.1rem; text-align:center;">Phòng tập</th>
                        <th style="text-align:center;">Sửa</th>
                        <th style="text-align:center;">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dslt as $i => $lt)
                        <tr style="height:72px; vertical-align:middle;">
                            <td style="text-align:center;">{{ $lt['id'] }}</td>
                            <td style="text-align:center; font-weight:500;">{{ $lt['Ten'] }}</td>
                            <td style="text-align:center;">{{ $lt['BatDau'] }}</td>
                            <td style="text-align:center;">{{ $lt['KetThuc'] }}</td>
                            <td style="text-align:center;">{{ $lt['NgayTap'] }}</td>
                            <td style="text-align:center;">{{ $lt['phongtap'] }}</td>
                            <td style="text-align:center;">
                                <a class="btn" style="background:#ffc107 ; color:#fff; font-size:1.3rem; border-radius:50%; padding:10px 14px; box-shadow:0 2px 6px #bbb; display:inline-flex; align-items:center; justify-content:center;" href="javascript:void(0);" onclick="showUpdateModal(this)" data-id="{{ $lt['id'] }}" data-Ten="{{ $lt['Ten'] }}" data-BatDau="{{ $lt['BatDau'] }}" data-KetThuc="{{ $lt['KetThuc'] }}" data-NgayTap="{{ $lt['NgayTap'] }}" data-phongtap="{{ $lt['phongtap'] }}" data-training-category-id="{{ $lt['training_category_id'] }}"> <!-- Thêm danh mục -->
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td style="text-align:center;">
                                <a class="btn" style="background:#e74c3c; color:#fff; font-size:1.3rem; border-radius:50%; padding:10px 14px; box-shadow:0 2px 6px #bbb; display:inline-flex; align-items:center; justify-content:center;" href="{{ route('admin.lichtap.delete', ['id' => $lt['id']]) }}"><i class="fa fa-trash"></i></a>
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
    var Ten = btn.getAttribute('data-Ten');
    var BatDau = btn.getAttribute('data-BatDau');
    var KetThuc = btn.getAttribute('data-KetThuc');
    var NgayTap = btn.getAttribute('data-NgayTap');
    var phongtap = btn.getAttribute('data-phongtap');
    var trainingCategoryId = btn.getAttribute('data-training-category-id'); // Lấy danh mục

    // Điền dữ liệu vào form update
    document.getElementById('update-Ten').value = Ten;
    document.getElementById('update-BatDau').value = BatDau;
    document.getElementById('update-KetThuc').value = KetThuc;
    document.getElementById('update-NgayTap').value = NgayTap;
    document.getElementById('update-phongtap').value = phongtap;
    document.getElementById('update-training-category').value = trainingCategoryId; // Điền danh mục

    // Set action cho form
    var form = document.getElementById('updateForm');
    form.action = '/admin/lichtap/update/' + id;

    // Hiện modal
    document.getElementById('id02').style.display = 'block';
}
</script>
