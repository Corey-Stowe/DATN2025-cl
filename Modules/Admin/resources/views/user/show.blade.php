@extends('admin::layout.master')
@section('title')
    Chi tiết tài khoản {{ $user->user_name }}
@endsection

@section('css-libs')
    <link href="{{ asset('theme/admin/vendors/choices/choices.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/vendors/dropzone/dropzone.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap-5.3.3/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('dataTables/datatables.css') }}">
    <script src="{{ asset('dataTables/datatables.js') }}"></script>
    <script src="{{ asset('sweetalert2/sweetalert2.all.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('css-setting')
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body">
            <div class="row flex-between-center">
                <div class="col-md">
                    <h5 class="mb-2 mb-md-0"> Chi tiết tài khoản {{ $user->user_name }}</h5>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Danh sách</a>
                    {{-- <button type="submit" class="btn btn-primary" id='submit-button'>Áp dụng
                        </button> --}}
                    {{-- <a href="{{ route('admin.accounts.edit', ['id' => $user->id]) }}" class="btn btn-primary">Sửa</a> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="row g-0">
        <div class="col-lg-8 pe-lg-2">
            <div class="card mb-3">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Thông tin cơ bản</h6>
                </div>
                <div class="card-body">

                    <div class="row gx-2">
                        <div class="col-6 mb-3">
                            <label class="form-label" for="user_name">Tên đăng nhập:</label>
                            <input class="form-control" name="user_name" id="user_name" disabled type="text"
                                value="{{ $user->user_name }}" />
                            @error('user_name')
                                <label class="form-label text-danger">{{ $message }} </label>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="full_name">Họ và tên:</label>
                            <input class="form-control" name="full_name" id="full_name" type="text"
                                value="{{ $user->full_name }}" disabled />
                            @error('full_name')
                                <label class="form-label text-danger">{{ $message }} </label>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="phone">Số điện thoại</label>
                            <input class="form-control" name="phone" id="phone" type="text"
                                value="{{ $user->phone }}" disabled />
                            @error('phone')
                                <label class="form-label text-danger">{{ $message }} </label>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" name="email" id="email" type="text"
                                value="{{ $user->email }}" disabled />
                            @error('email')
                                <label class="form-label text-danger">{{ $message }} </label>
                            @enderror
                        </div>
                        {{-- <div class="col-6 mb-3">
                                <label class="form-label" for="password">Mật khẩu</label>
                                <input class="form-control" name="password" id="password" type="password" />
                                @error('password')<label class="form-label text-danger">{{ $message }} </label>@enderror
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label" for="re_enter_password">Nhập lại mật khẩu</label>
                                <input class="form-control" name="re_enter_password" id="re_enter_password"
                                    type="password" />
                                    @error('re_enter_password')<label class="form-label text-danger">{{ $message }} </label>@enderror
                            </div> --}}
                        <div class="col-12 mb-3">
                            <label class="form-label" for="address">Địa chỉ:</label>
                            <input class="form-control" name="address" id="address" type="text"
                                value="{{ $user->address }}" disabled />
                            @error('address')
                                <label class="form-label text-danger">{{ $message }} </label>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Danh sách giao dịch</h6>

                </div>
                <div class="card-body">
                    <div class="card mb-3" id="ordersTable"
                        data-list='{"valueNames":["order","address","status_order","status_payment"],"filter":{"key":"status_order"}}'>
                        <form action="{{ route('admin.invoice.bulkActions') }}" method="POST">
                            @csrf
                            <div class="card-header">
                                <div class="row flex-between-center">
                                    <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                                        @if (session()->has('error'))
                                            <h5 class="fs-9 mb-0 text-nowrap py-2 py-xl-0 text-warning">
                                                {{ session('error') }}</h5>
                                        @else
                                            @if (session()->has('success'))
                                                <h5 class="fs-9 mb-0 text-nowrap py-2 py-xl-0 text-success">
                                                    {{ session('success') }}</h5>
                                            @else
                                                <h5 class="fs-9 mb-0 text-nowrap py-2 py-xl-0">ĐƠN HÀNG</h5>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col-8 col-sm-auto ms-auto text-end ps-0">
                                        <div class="d-none" id="orders-bulk-actions">
                                            <div class="d-flex">
                                                <select class="form-select form-select-sm" name="slAction"
                                                    aria-label="Bulk actions">
                                                    <option value="sltNull" selected>Chọn hành động</option>
                                                    <option value="confirmed">Đã xác nhận</option>
                                                    <option value="shipping">Đang giao hàng</option>
                                                    <option value="print_invoices">In hoá đơn</option>
                                                </select>
                                                <input type="submit" class="btn btn-falcon-default btn-sm ms-2"
                                                    name="btnApply" value="Áp dụng hàng loạt">
                                            </div>
                                        </div>
                                        {{-- <div id="orders-actions">
                                            <button class="btn btn-falcon-default btn-sm mx-2" type="button">
                                                <span class="fas fa-filter" data-fa-transform="shrink-3 down-2"></span>
                                                <span class="d-none d-sm-inline-block ms-1">Hành động</span>
                                            </button>
                                        </div> --}}
                                    </div>
                                </div>
                                <hr>
                                <div class="row flex-between-center mb-3">
                                    <div class="col-6 col-sm-auto d-flex align-items-center pe-0">
                                        <div class="input-group">
                                            <input class="form-control form-control-sm shadow-none search" type="search"
                                                placeholder="Tìm kiếm tại đây" aria-label="search" />
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-auto ms-auto text-end ps-0">
                                        <select class="form-select form-select-sm mb-3" aria-label="Bulk actions"
                                            data-list-filter="data-list-filter">
                                            <option selected value="sltNull">Lọc theo trạng thái đơn hàng</option>
                                            @foreach (\App\Models\Order::STATUS_ORDER as $value)
                                                <option value="{{ $value }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive scrollbar">
                                    <table class="table table-sm table-striped fs-10 mb-0 overflow-hidden">
                                        <thead class="bg-200">
                                            <tr>
                                                {{-- <th>
                                                    <div class="form-check fs-9 mb-0 d-flex align-items-center">
                                                        <input class="form-check-input"
                                                            id="checkbox-bulk-customers-select" type="checkbox"
                                                            data-bulk-select='{"body":"table-orders-body","actions":"orders-bulk-actions","replacedElement":"orders-actions"}' />
                                                    </div>
                                                </th> --}}
                                                <th class="text-900 sort pe-1 align-middle white-space-nowrap"
                                                    data-sort="order">Đơn hàng
                                                </th>
                                                <th class="text-900 sort pe-1 align-middle white-space-nowrap pe-7">Ngày
                                                    đặt</th>

                                                <th class="text-900 sort pe-1 align-middle white-space-nowrap text-center"
                                                    data-sort="status_order">
                                                    Trạng thái đơn hàng
                                                </th>
                                                <th class="text-900 sort pe-1 align-middle white-space-nowrap text-center"
                                                    data-sort="status_payment">
                                                    Trạng thái thanh toán
                                                </th>
                                                <th class="text-900 sort pe-1 align-middle white-space-nowrap text-end">
                                                    Tổng đơn hàng (VNĐ)
                                                </th>
                                                <th class="no-sort"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list" id="table-orders-body">
                                            @php
                                                $badgeColors = [
                                                    $statusOrder['reorder'] => 'warning',
                                                    $statusOrder['pending'] => 'secondary',
                                                    $statusOrder['confirmed'] => 'info',
                                                    $statusOrder['shipping'] => 'primary',
                                                    $statusOrder['received'] => 'success',
                                                    $statusOrder['canceled'] => 'danger',
                                                    $statusPayment['paid'] => 'success',
                                                    $statusPayment['unpaid'] => 'danger',
                                                ];
                                            @endphp
                                            @foreach ($userOrder as $order)
                                                <tr class="btn-reveal-trigger">
                                                    {{-- <td class="align-middle" style="width: 28px;">
                                                        <div class="form-check fs-9 mb-0 d-flex align-items-center">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="idOrder[]" id="checkbox-{{ $order->id }}"
                                                                data-bulk-select-row="data-bulk-select-row"
                                                                value="{{ $order->id }}" />
                                                        </div>
                                                    </td> --}}
                                                    <td class="order py-2 align-middle white-space-nowrap">
                                                        <a href="{{ route('admin.orders.detail', $order->id) }}">
                                                            <strong>#{{ $order->id }}</strong>
                                                        </a>
                                                        của <strong>{{ $order->user_name }}</strong>
                                                        <br />
                                                        <a
                                                            href="mailto:{{ $order->user_email }}">{{ $order->user_email }}</a>
                                                    </td>
                                                    <td class="py-2 align-middle">{{ $order->date_create_order }}</td>

                                                    <td
                                                        class="status_order py-2 align-middle text-center fs-9 white-space-nowrap">
                                                        <span
                                                            class="badge badge rounded-pill d-block badge-subtle-{{ $badgeColors[$order->status_order] }}">
                                                            {{ $order->status_order }}
                                                        </span>
                                                    </td>
                                                    <td
                                                        class="status_payment py-2 align-middle text-center fs-9 white-space-nowrap">
                                                        <span
                                                            class="badge badge rounded-pill d-block badge-subtle-{{ $badgeColors[$order->status_payment] }}">
                                                            {{ $order->status_payment }}
                                                        </span>
                                                    </td>
                                                    <td class="py-2 align-middle text-end fs-9 fw-medium">
                                                        {{ number_format((int) $order->total_price, 0, ',', '.') }}
                                                    </td>
                                                    <td class="py-2 align-middle white-space-nowrap text-end">
                                                        <div class="dropdown font-sans-serif position-static">
                                                            <button
                                                                class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal"
                                                                type="button" id="order-dropdown-{{ $order->id }}"
                                                                data-bs-toggle="dropdown" data-boundary="viewport"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <span class="fas fa-ellipsis-h fs-10"></span>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end border py-0"
                                                                aria-labelledby="order-dropdown-0">
                                                                <div class="py-2">
                                                                    <a class="dropdown-item text-warning"
                                                                        href="{{ route('admin.orders.detail', $order) }}">Chi
                                                                        tiết</a>
                                                                    <a class="dropdown-item text-primary"
                                                                        href="{{ route('admin.invoice.save', $order) }}">In
                                                                        hóa đơn</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-12">
                                    {{ $userOrder->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ps-lg-2">
            <div class="sticky-sidebar">
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Ảnh tài khoản</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-12 mb-3">
                                <img class="img-fluid" src="{{ Storage::url($user->user_image) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Loại tài khoản</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-12 mb-3">
                                <input class="form-control" name="role_type" id="role_type" type="text"
                                    value="Khách hàng" disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Trạng thái</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-12 mb-3">
                                <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label class="form-label" for="status">Chọn trạng thái:</label>
                                    {{-- <input class="form-control" name="status" id="status" type="text"
                                        value="@if ($user->status == 'active') kích hoạt @else chưa kích hoạt @endif
                                    " /> --}}
                                    <select name="status" class="form-control mb-3" id="">
                                        <option value="active" @if ($user->status == 'active') selected @endif>Kích hoạt
                                        </option>
                                        <option value="deactive" @if ($user->status == 'deactive') selected @endif>Chưa
                                            kích hoạt</option>
                                    </select>
                                    <input name="" id="" class="btn btn-primary" type="submit"
                                        value="Lưu" />
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="card mb-3">
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Tags</h6>
                        </div>
                        <div class="card-body"><label class="form-label" for="product-tags">Add a keyword:</label><input
                                class="form-control js-choice" id="product-tags" type="text" name="tags"
                                required="required" size="1"
                                data-options='{"removeItemButton":true,"placeholder":false}' /></div>
                    </div>
                     --}}
            </div>
        </div>
    </div>
    </div>
    {{-- <div class="card mt-3">
            <div class="card-body">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md">
                        <h5 class="mb-2 mb-md-0"></h5>
                    </div>
                    <div class="col-auto"> <button class="btn btn-link text-secondary p-0 me-3 fw-medium" role="button">Hủy</button><button
                        type="submit" class="btn btn-primary" role="button">Thêm mã giảm giá
                    </button>
                    </div>
                </div>
            </div>
        </div> --}}
@endsection
@section('js-libs')
    <script src="{{ asset('theme/admin/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/choices/choices.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/dropzone/dropzone-min.js') }}"></script>
@endsection
@section('js-setting')
    <script>
        // xử lý upload file bằng thư biên dropzone
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#dropzoneMultipleFileUpload", {
            url: "#", // Không cần URL vì sẽ submit form thông thường
            autoProcessQueue: false, // Không tự động upload
            // paramName: "product_galleries", // Tên của input trong request
            uploadMultiple: false, // Cho phép chọn nhiều file
            parallelUploads: 10, // Giới hạn số file upload đồng thời
            maxFilesize: 5, // Kích thước file tối đa
            acceptedFiles: "image/*", // Chỉ nhận file ảnh
            previewsContainer: document.querySelector(".dz-preview"),
            previewTemplate: document.querySelector(".dz-preview").innerHTML,
            clickable: true, // Cho phép người dùng click vào vùng Dropzone để chọn file
            // dictDefaultMessage: 'Drag your image here or, Browse',
            init: function() {
                var myDropzone = this;
                document.querySelector(".dz-preview").innerHTML = "";
                // Khi nhấn nút submit
                document.getElementById("submit-button").addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    // Nếu có file trong Dropzone
                    if (myDropzone.getAcceptedFiles().length > 0) {
                        var hiddenFilesInput = document.getElementById('hidden-files');
                        var dataTransfer =
                            new DataTransfer(); // Sử dụng DataTransfer để chứa nhiều file
                        // Thêm từng file từ Dropzone vào DataTransfer
                        myDropzone.getAcceptedFiles().forEach(function(file) {
                            dataTransfer.items.add(file);
                        });
                        // Gán danh sách file vào input file ẩn
                        hiddenFilesInput.files = dataTransfer.files;
                        // Sau đó submit form bình thường
                        Swal.fire({
                            title: 'Bạn có chắc chắn sửa không?',
                            text: "Hành động này không thể hoàn tác!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Vâng, áp dụng!',
                            cancelButtonText: 'Hủy'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // If confirmed, submit the form
                                document.getElementById("create").submit();
                            }
                        });

                    } else {
                        // Nếu không có file trong Dropzone, submit form ngay lập tức
                        Swal.fire({
                            title: 'Bạn có chắc chắn sửa không?',
                            text: "Hành động này không thể hoàn tác!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Vâng, áp dụng!',
                            cancelButtonText: 'Hủy'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // If confirmed, submit the form
                                document.getElementById("create").submit();
                            }
                        });

                    }
                });
            }
        });
    </script>


    @if (session('success'))
        <script>
            Swal.fire({
                title: "Thành Công",
                text: "{{ session('success') }}",
                icon: "success"
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: "Thất bại",
                text: "{{ session('error') }}",
                icon: "error"
            });
        </script>
    @endif

    @if (session('info'))
        <script>
            Swal.fire({
                title: "Thông tin",
                text: "{{ session('info') }}",
                icon: "info"
            });
        </script>
    @endif
@endsection
