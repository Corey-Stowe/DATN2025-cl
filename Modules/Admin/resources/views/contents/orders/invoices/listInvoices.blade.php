@extends('admin::layout.master')

@section('title')
    DANH SÁCH ĐƠN HÀNG
@endsection

@section('contents')
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-center">
                <div class="col-auto col-sm-auto d-flex align-items-center pe-0">
                    <h5 class="fs-9 mb-0 text-nowrap py-2 py-xl-0">DANH SÁCH HÓA ĐƠN</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header d-flex flex-between-center bg-body-tertiary py-2">
            <h6 class="mb-0">Shared Files</h6>
        </div>
        <div class="card-body pb-0">
            <div id="tableExample3" data-list='{"valueNames":["name","email"]}'>
                <div class="row justify-content-end g-0">
                    <div class="col-auto col-sm-5 mb-3">
                        <div class="input-group">
                            <input class="form-control form-control-sm shadow-none search" type="search"
                                placeholder="Tìm kiếm file ..." aria-label="search" />
                        </div>
                    </div>
                </div>
                <div class="table-responsive scrollbar">
                    <table class="table table-bordered table-striped fs-10 mb-0">
                        <thead class="bg-200">
                            <tr>
                                <th class="text-900 sort" data-sort="name">Tên file</th>
                                <th class="text-900 sort" data-sort="email">Dung lượng</th>
                                <th class="text-900 sort"></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($paginatedFiles as $file)
                                <tr>
                                    <td class="name">{{ $file['name'] }}</td>
                                    <td class="email">{{ number_format($file['size'] / 1024, 2) }} KB</td>
                                    <td class="align-middle white-space-nowrap text-end">
                                        <a class="btn btn-tertiary border-300 btn-sm me-1 text-600" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Download"
                                            href="{{ \Storage::url('invoices/' . $file['name']) }}"
                                            download="{{ $file['name'] }}">
                                            <img src="{{ asset('theme/admin/img/icons/cloud-download.svg') }}"
                                                alt="" width="15" />
                                        </a>
                                        <a class="btn btn-tertiary border-300 btn-sm me-1 text-600" data-bs-toggle="tooltip"
                                            data-bs-placement="top" href="{{ \Storage::url('invoices/' . $file['name']) }}"
                                            target="_blank">
                                            <span class="far fa-share-square"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-12">
                    {{ $paginatedFiles->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
