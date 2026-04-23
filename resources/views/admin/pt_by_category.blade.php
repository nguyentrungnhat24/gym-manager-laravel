@extends('admin.layouts.app')
@section('title', 'PT Theo Danh Mục')
@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Danh sách PT theo danh mục</h2>
    @forelse($categories as $category)
        <div class="mb-5">
            <h3 class="text-primary">{{ $category->name }}</h3>
            @if($category->pts->isEmpty())
                <p class="text-muted">Không có PT nào trong danh mục này.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tên PT</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Quan điểm</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category->pts as $pt)
                            <tr>
                                <td>{{ $pt->id }}</td>
                                <td>{{ $pt->full_name }}</td>
                                <td>{{ $pt->phone_number }}</td>
                                <td>{{ $pt->email }}</td>
                                <td>{{ $pt->position }}</td>
                                <td>{{ $pt->philosophy }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @empty
        <p class="text-center text-danger">Không có danh mục nào được tìm thấy.</p>
    @endforelse
</div>
@endsection