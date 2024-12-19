@extends('admin::layout.master')
@section('title')
    ADMIN | QUẢN LÝ DANH MỤC
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body">
            <div class="row flex-between-center">
                <div class="col-md">
                    @if (session()->has('error'))
                        <h5 class="mb-2 mb-md-0 text-danger">{{ session('error') }}</h5>
                    @else
                        @if (session()->has('success'))
                            <h5 class="mb-2 mb-md-0 text-success">{{ session('success') }}</h5>
                        @else
                            <h5 class="mb-2 mb-md-0">Danh mục</h5>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row g-0">
        <div class="col-lg-8 pe-lg-2">
            <div class="card mb-3">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Danh mục</h6>
                </div>
                <div class="card-body">
                    <div id="tableExample3" data-list='{"valueNames":["stt","dm"]}'>
                        <div class="table-responsive scrollbar">
                            <table class="table table-bordered table-striped fs-10 mb-0">
                                <thead class="bg-200">
                                    <tr>
                                        <th class="text-900 sort text-center" data-sort="stt" style="width: 50px;">#</th>
                                        <th class="text-900 sort" data-sort="dm">Tên danh mục</th>
                                        <th class="text-900">Ghi chú</th>
                                        <th class="text-900">Ảnh</th>
                                        <th class="text-900"></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if (isset($data) && count($data) > 0)
                                        @foreach ($data as $item)
                                            <tr>
                                                <td class="stt">{{ $item->id }}</td>
                                                <td class="dm">
                                                    <strong>{{ $item->name }}</strong><br>
                                                    {{ $item->slug }}
                                                </td>
                                                <td>
                                                    <h6 class="text-start">{{ $item->note }}</h6>
                                                </td>
                                                <td>
                                                    <h6 class="text-center">
                                                        @php
                                                            $url = $item->image_cover;
                                                            if (!\Str::contains($url, 'http')) {
                                                                $url = \Storage::url($url);
                                                            }
                                                        @endphp
                                                        <img src="{{ $url }}" alt="....." width="100px">
                                                    </h6>
                                                </td>
                                                <td class="align-middle white-space-nowrap">
                                                    <div class="dropstart font-sans-serif position-static d-inline-block">
                                                        <button
                                                            class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-end"
                                                            type="button" id="dropdown-number-pagination-table-item-0"
                                                            data-bs-toggle="dropdown" data-boundary="window"
                                                            aria-haspopup="true" aria-expanded="false"
                                                            data-bs-reference="parent">
                                                            <span class="fas fa-ellipsis-h fs-10"></span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end border py-2"
                                                            aria-labelledby="dropdown-number-pagination-table-item-0">
                                                            <a class="dropdown-item text-center"
                                                                href="{{ route('admin.categories.edit_pl', $item->slug) }}">
                                                                <span class="btn btn-warning">Cập nhật</span>
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <form action="{{ route('admin.categories.delete_pl', $item) }}"
                                                                method="post" style="text-align: center;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger"
                                                                    onclick="return confirm('Có chắc chắn muốn xóa không?')"
                                                                    type="submit">Xóa</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="4">
                                                <strong class="text-warning">Danh sách trống!</strong>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Danh mục phụ</h6>
                </div>
                <div class="card-body">
                    <div id="tableExample3" data-list='{"valueNames":["stt","dm"]}'>
                        <div class="table-responsive scrollbar">
                            <table class="table table-bordered table-striped fs-10 mb-0">
                                <thead class="bg-200">
                                    <tr>
                                        <th class="text-900 sort text-center" data-sort="stt" style="width: 50px;">#</th>
                                        <th class="text-900 sort" data-sort="dm">Tên danh mục</th>
                                        <th class="text-900">Ghi chú</th>
                                        <th class="text-900"></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if (isset($data2) && count($data2) > 0)
                                        @foreach ($data2 as $item)
                                            <tr>
                                                <td class="stt">{{ $item->id }}</td>
                                                <td class="dm">
                                                    <strong>{{ $item->name }}</strong><br>
                                                    {{ $item->slug }}
                                                </td>
                                                <td>
                                                    <h6 class="text-center">{{ $item->note }}</h6>
                                                </td>
                                                <td class="align-middle white-space-nowrap">
                                                    <div class="dropstart font-sans-serif position-static d-inline-block">
                                                        <button
                                                            class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-end"
                                                            type="button" id="dropdown-number-pagination-table-item-0"
                                                            data-bs-toggle="dropdown" data-boundary="window"
                                                            aria-haspopup="true" aria-expanded="false"
                                                            data-bs-reference="parent">
                                                            <span class="fas fa-ellipsis-h fs-10"></span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end border py-2"
                                                            aria-labelledby="dropdown-number-pagination-table-item-0">
                                                            <a class="dropdown-item text-center"
                                                                href="{{ route('admin.categories.edit_dm', $item->slug) }}">
                                                                <span class="btn btn-warning">Cập nhật</span>
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <form action="{{ route('admin.categories.delete_dm', $item) }}"
                                                                method="post" style="text-align: center;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger"
                                                                    onclick="return confirm('Có chắc chắn muốn xóa không?')"
                                                                    type="submit">Xóa</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="4">
                                                <strong class="text-warning">Danh sách trống!</strong>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            {{ $data2->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ps-lg-2">
            <div class="sticky-sidebar">
                <div class="card mb-3 rendFormEdit"></div>
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Thêm mới danh mục lớn</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <form action="{{ route('admin.categories.them_pl') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="name">Nhập tên:</label>
                                    <input class="form-control" type="text" name="name" id="name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <label class="form-label text-danger" for="name">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="note">Ghi chú:</label>
                                    <textarea class="form-control" name="note" id="note" rows="3">
                                        {{ old('note') }}
                                    </textarea>
                                    @error('note')
                                        <label class="form-label text-danger" for="name">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="img_cover">Ảnh:</label>
                                    <input class="form-control" type="file" name="img_cover" id="img_cover">
                                    @error('img_cover')
                                        <label class="form-label text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success">Thêm mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Thêm mới danh mục phụ</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <form action="{{ route('admin.categories.them_dm') }}" method="post">
                                @csrf
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="id_phan_loai">Chọn danh mục:</label>
                                        <select class="form-select" id="id_phan_loai"
                                            data-options='{"placeholder":"Chọn danh mục"}' name="id_phan_loai">
                                            <option value="">-- Chọn danh mục --</option>
                                            @foreach ($data as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_phan_loai')
                                            <label class="form-label text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="name_sub">Nhập tên:</label>
                                    <input class="form-control" type="text" name="name_sub" id="name_sub"
                                        value="{{ old('name_sub') }}">
                                    @error('name_sub')
                                        <label class="form-label text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="note_sub">Mô tả ngắn:</label>
                                    <textarea class="form-control" name="note_sub" id="note_sub">
                                    {{ old('note_sub') }}
                                </textarea>
                                    @error('note_sub')
                                        <label class="form-label text-danger" for="name">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success">Tạo mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
