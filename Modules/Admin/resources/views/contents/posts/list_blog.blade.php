@extends('admin::layout.master')
@section('title')
    Admin | DANH SÁCH BÀI VIẾT-TIN TỨC
@endsection
@section('contents')
    <div class="card mb-3" id="tableExample3"
        data-list='{"valueNames":["id","image_post","title","short_description","created_at","published_id"]}'>
        <div class="card-header">
            <div class="row flex-between-center">
                <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                    @if (session('success'))
                        <h5 class="fs-9 mb-0 text-success py-2 py-xl-0">{{ session('success') }}</h5>
                    @else
                        @if (session('error'))
                            <h5 class="fs-9 mb-0 text-danger py-2 py-xl-0">{{ session('error') }}</h5>
                        @else
                            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Thêm mới</a>
                        @endif
                    @endif
                </div>
                <div class="col-4 col-sm-4 d-flex pe-0">
                    <input class="form-control form-control-sm shadow-none search" type="search"
                        placeholder="Tìm kiếm tại đây..." aria-label="search" />
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="falcon-data-table">
                <table class="table table-sm mb-0 data-table fs-10">
                    <thead class="bg-200">
                        <tr>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="id">#</th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="image_post">
                                Ảnh đại diện
                            </th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="title">Tiêu đề</th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="short_description">
                                Mô tả ngắn
                            </th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="created_at">
                                Ngày tạo
                            </th>
                            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="published_id">Trạng thái
                            </th>
                            <th class="text-900 no-sort pe-1 align-middle data-table-row-action">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="list" id="table-purchase-body">
                        @foreach ($posts as $item)
                            <tr class="btn-reveal-trigger">
                                <td class="align-middle id">#{{ $item->id }}</td>
                                <td class="align-middle white-space-nowrap image">
                                    <img src="{{ \Storage::url($item->image_post) }}" alt="Error!" width="100px">
                                </td>
                                <td class="align-middle white-space-nowrap fw-semi-bold title">
                                    <a href="{{ route('admin.posts.showPost', $item->slug_post) }}">{{ $item->title }}</a>
                                </td>
                                <td class="align-middle text-start view">{{ Str::limit($item->short_description, 100) }}</td>
                                <td class="align-middle text-start date">{{ $item->created_at }}</td>
                                {{-- <td class="align-middle text-start published_id">{{ $item->published_id }}</td> --}}
                                <td class="align-middle white-space-nowrap status">
                                    {!! $item->published_id == 1
                                        ? '<span class="badge rounded-pill badge-subtle-success">Đã xuất bản<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span>'
                                        : '<span class="badge rounded-pill badge-subtle-danger">Chưa xuất bản<span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span>' !!}
                                </td>
                                <td class="align-middle white-space-nowrap">
                                    <div class="dropstart font-sans-serif position-static d-inline-block">
                                        <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-end"
                                            type="button" id="dropdown-number-pagination-table-item-0"
                                            data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true"
                                            aria-expanded="false" data-bs-reference="parent">
                                            <span class="fas fa-ellipsis-h fs-10"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end border py-2"
                                            aria-labelledby="dropdown-number-pagination-table-item-0">
                                            <a class="dropdown-item text-center"
                                                href="{{ route('admin.posts.showPost', $item->slug_post) }}">
                                                <span class="btn btn-info">Chi tiết</span>
                                            </a>
                                            <a class="dropdown-item text-center"
                                                href="{{ route('admin.posts.editPost', $item->slug_post) }}">
                                                <span class="btn btn-warning">Cập nhật</span>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{route('admin.posts.destroy', $item->id)}}" method="post"
                                                style="text-align: center;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger"
                                                    onclick="return confirm('Có chắc chắn muốn xóa không?')"
                                                    type="submit">Xóa mềm</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- PAGINATE PAGES --}}
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-12">
                    {{ $posts->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
