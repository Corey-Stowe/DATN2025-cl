@extends('admin::layout.master')

@section('title')
    Admin | Danh sách tags
@endsection

@section('contents')
    <div class="card mb-3">
        <div class="card-header">
            <div class="d-flex flex-between-center">
                @if (session()->has('error'))
                    <h5 class="mb-2 mb-md-0 text-danger">{{ session('error') }}</h5>
                @else
                    @if (session()->has('success'))
                        <h5 class="mb-2 mb-md-0 text-success">{{ session('success') }}</h5>
                    @else
                        <h5 class="mb-2 mb-md-0">Danh sách tags</h5>
                    @endif
                @endif
                <button class="btn btn-primary mb-0" type="button" data-bs-toggle="modal" data-bs-target="#addTag-modal">
                    Thêm mới
                </button>
            </div>
        </div>
        <div class="card-body px-0">
            <div class="tab-content">
                <div class="tab-pane preview-tab-pane active" role="tabpanel"
                    aria-labelledby="tab-dom-023429b2-f0b9-4091-bf3c-0936e4daf000"
                    id="dom-023429b2-f0b9-4091-bf3c-0936e4daf000">
                    <table class="table mb-0 data-table fs-10" data-datatables="data-datatables">
                        <thead class="bg-200">
                            <tr>
                                <th class="text-900 sort">#</th>
                                <th class="text-900 sort">Tên thẻ</th>
                                <th class="text-900 sort">Slug</th>
                                <th class="text-900 no-sort pe-1 align-middle data-table-row-action"></th>
                            </tr>
                        </thead>
                        <tbody class="list" id="table-simple-pagination-body">
                            @if (count($data) > 0)
                                @foreach ($data as $item)
                                    <tr class="btn-reveal-trigger">
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->slug }}</td>
                                        <td class="align-middle white-space-nowrap text-end">
                                            <a class="btn btn-danger" href="{{ route('admin.tags.delete', $item->slug) }}"
                                                onclick="return confirm('Có chắc chắn muốn xóa không!')">Xóa thẻ</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="btn-reveal-trigger">
                                    <td colspan="4">
                                        <h5 class="text-warning">Danh sách trống!</h5>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                        @error('name')
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="align-middle white-space-nowrap text-start">
                                        <h5 class="text-danger">{{ $message }}</h5>
                                    </td>
                                </tr>
                            </tfoot>
                        @enderror
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addTag-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <form action="{{ route('admin.tags.create') }}" class="modal-content position-relative" method="POST">
                @csrf
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <a class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal"
                        aria-label="Close"></a>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Thêm mới 1 tag</h4>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="mb-3">
                            <label class="col-form-label" for="recipient-name">Tên thẻ:</label>
                            <input class="form-control" id="recipient-name" type="text" name="name" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Đóng</button>
                    <button class="btn btn-primary" type="submit">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
@endsection
