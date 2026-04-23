@extends('admin.layouts.app')
@section('title', 'Quản lý Dụng Cụ')
@section('content')

<!-- Modal Thêm Dụng Cụ -->
<div id="addModal" class="modal">
  <form class="modal-content animate nv-form-modal" action="{{ route('admin.dungcu.add') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container" style="padding:0;">
      <h3 class="mb-4 nv-form-modal-title">Thông tin Dụng Cụ</h3>

      <div class="nv-form-group">
        <label class="nv-form-label">Tên dụng cụ</label>
        <input type="text" name="tendc" value="{{ old('tendc') }}" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Danh mục</label>
        <select name="iddmdc" required class="nv-form-input">
          <option value="">Chọn danh mục</option>
          @foreach($danhMucDungCu as $dm)
            <option value="{{ $dm->id }}" {{ old('iddmdc') == $dm->id ? 'selected' : '' }}>{{ $dm->tendmdc }}</option>
          @endforeach
        </select>
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Giá</label>
        <input type="number" step="1000" name="gia" value="{{ old('gia') }}" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Số lượng</label>
        <input type="number" min="1" name="soluong" value="{{ old('soluong', 1) }}" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Tình trạng</label>
        <select name="tinhtrang" required class="nv-form-input">
          <option value="Mới" {{ old('tinhtrang') == 'Mới' ? 'selected' : '' }}>Mới</option>
          <option value="Đã qua sử dụng" {{ old('tinhtrang') == 'Đã qua sử dụng' ? 'selected' : '' }}>Đã qua sử dụng</option>
        </select>
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Hình ảnh</label>
        <input type="file" name="image" accept="image/*" required class="nv-form-input">
      </div>

      <input type="hidden" name="themmoi" value="1">

      <input type="submit" class="btn btn-success w-100 mt-2 nv-btn-modal"  style="font-size: 13px" value="Thêm Dụng Cụ">
      <button type="button" onclick="document.getElementById('addModal').style.display='none'" class="btn btn-danger w-100 mt-2 nv-btn-modal">Hủy</button>
    </div>
  </form>
</div>

<!-- Modal Cập nhật Dụng Cụ -->
<div id="updateModal" class="modal" style="display:none;">
  <form id="updateForm" class="modal-content animate nv-form-modal" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="container" style="padding:0;">
      <h3 class="mb-4 nv-form-modal-title">Cập nhật Dụng Cụ</h3>

      <div class="nv-form-group">
        <label class="nv-form-label">Tên dụng cụ</label>
        <input type="text" name="tendc" id="update-tendc" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Danh mục</label>
        <select name="iddmdc" id="update-iddmdc" required class="nv-form-input">
          @foreach($danhMucDungCu as $dm)
            <option value="{{ $dm->id }}">{{ $dm->tendmdc }}</option>
          @endforeach
        </select>
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Giá</label>
        <input type="number" step="1000" name="gia" id="update-gia" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Số lượng</label>
        <input type="number" min="1" name="soluong" id="update-soluong" required class="nv-form-input">
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Tình trạng</label>
        <select name="tinhtrang" id="update-tinhtrang" required class="nv-form-input">
          <option value="Mới">Mới</option>
          <option value="Đã qua sử dụng">Đã qua sử dụng</option>
        </select>
      </div>

      <div class="nv-form-group">
        <label class="nv-form-label">Hình ảnh (để trống nếu không thay đổi)</label>
        <input type="file" name="image" accept="image/*" class="nv-form-input">
      </div>

      <input type="submit" class="btn btn-success w-100 mt-2 nv-btn-modal" value="Cập nhật">
      <button type="button" onclick="document.getElementById('updateModal').style.display='none'" class="btn btn-danger w-100 mt-2 nv-btn-modal">Hủy</button>
    </div>
  </form>
</div>

<div class="container section">
  <section class="attendance">
    <div class="attendance-list" style="max-width:1200px; margin:0 auto; background:#fff; border-radius:18px; box-shadow:0 8px 24px rgba(0,0,0,0.13); padding:32px 24px 32px 24px;">
      <h2 class="title" style="font-size:2.2rem; text-shadow:2px 2px 4px #333; margin-bottom:24px;">QUẢN LÝ DỤNG CỤ:</h2>
      <div class="d-flex flex-row mb-3" style="gap: 1.2rem;">
        <button onclick="document.getElementById('addModal').style.display='block'" class="btn btn-success" style="font-size:1.1rem; padding:10px 24px; border-radius:8px;"><i class="fa fa-plus-square"></i> Thêm Dụng Cụ</button>
      </div>

      @foreach($dungCuTheoDanhMuc as $danhMucId => $data)
        @if($data['dungCu']->count() > 0)
          <div class="mb-5">
            <h3 class="mb-3" style="color: #219150; font-size: 1.7rem; border-bottom: 2px solid #219150; padding-bottom: 8px;">
              {{ $data['danhMuc']->tendmdc }}
            </h3>
            <div class="row">
              @foreach($data['dungCu'] as $dc)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                  <div class="card h-100" style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: transform 0.2s;">
                    <div style="height: 200px; overflow: hidden; border-radius: 12px 12px 0 0;">
                      @if($dc->image)
                        <img src="{{ asset($dc->image) }}" class="card-img-top" alt="{{ $dc->tendc }}" style="width: 100%; height: 100%; object-fit: cover;">
                      @else
                        <div style="width: 100%; height: 100%; background: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                          <i class="fas fa-image" style="font-size: 3rem; color: #ccc;"></i>
                        </div>
                      @endif
                    </div>
                    <div class="card-body d-flex flex-column">
                      <h5 class="card-title" style="font-size: 1.7rem; font-weight: 600; margin-bottom: 8px;">{{ $dc->tendc }}</h5>
                      <p class="card-text mb-2" style="font-size: 16px">
                        <strong>Giá:</strong> {{ number_format($dc->gia) }} VNĐ
                      </p>
                      <p class="card-text mb-2" style="font-size: 16px">
                        <strong>Số lượng:</strong> {{ $dc->soluong }}
                      </p>
                      <p class="card-text mb-3" style="font-size: 16px">
                        <strong>Tình trạng:</strong>
                        @if($dc->tinhtrang == 'Mới')
                          <span class="badge bg-success">Mới</span>
                        @else
                          <span class="badge bg-warning">Đã qua sử dụng</span>
                        @endif
                      </p>
                      <div class="mt-auto d-flex gap-2">
                        <button class="btn btn-warning btn-sm flex-fill"  style="font-size: 13px"
                                onclick="showUpdateModal(this)"
                                data-id="{{ $dc->id }}"
                                data-tendc="{{ $dc->tendc }}"
                                data-iddmdc="{{ $dc->iddmdc }}"
                                data-gia="{{ $dc->gia }}"
                                data-soluong="{{ $dc->soluong }}"
                                data-tinhtrang="{{ $dc->tinhtrang }}">
                          <i class="fas fa-edit"></i> Sửa
                        </button>
                        <a href="{{ route('admin.dungcu.delete', ['id' => $dc->id]) }}" 
                           class="btn btn-danger btn-sm flex-fill" style="font-size: 13px"
                           onclick="return confirm('Bạn có chắc muốn xóa dụng cụ này?')">
                          <i class="fas fa-trash"></i> Xóa
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endif
      @endforeach

      @if(empty($dungCuTheoDanhMuc) || collect($dungCuTheoDanhMuc)->every(function($data) { return $data['dungCu']->count() == 0; }))
        <div class="text-center py-5">
          <i class="fas fa-box-open" style="font-size: 4rem; color: #ccc; margin-bottom: 1rem;"></i>
          <h4 style="color: #666;">Chưa có dụng cụ nào</h4>
          <p style="color: #999;">Hãy thêm dụng cụ đầu tiên để bắt đầu quản lý</p>
        </div>
      @endif
    </div>
  </section>
</div>

@endsection

<script>
function showUpdateModal(btn) {
  const id = btn.getAttribute('data-id');
  document.getElementById('update-tendc').value = btn.getAttribute('data-tendc');
  document.getElementById('update-iddmdc').value = btn.getAttribute('data-iddmdc');
  document.getElementById('update-gia').value = btn.getAttribute('data-gia');
  document.getElementById('update-soluong').value = btn.getAttribute('data-soluong');
  document.getElementById('update-tinhtrang').value = btn.getAttribute('data-tinhtrang');

  var form = document.getElementById('updateForm');
  form.action = '/admin/dungcu/update/' + id;
  document.getElementById('updateModal').style.display = 'block';
}

// Đóng modal khi click bên ngoài
window.onclick = function(event) {
  var addModal = document.getElementById('addModal');
  var updateModal = document.getElementById('updateModal');
  if (event.target == addModal) {
    addModal.style.display = "none";
  }
  if (event.target == updateModal) {
    updateModal.style.display = "none";
  }
}
</script>
