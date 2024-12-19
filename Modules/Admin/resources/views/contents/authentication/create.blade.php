@extends('admin::layout.master')
@section('title')
    Thêm mới tài khoản
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
    <form id="create" action="{{ route('admin.accounts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card mb-3">
            <div class="card-body">
                <div class="row flex-between-center">
                    <div class="col-md">
                        <h5 class="mb-2 mb-md-0">Thêm mới nhân viên</h5>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary">Danh sách</a>
                        <button type="submit" class="btn btn-primary" id='submit-button'>Thêm tài khoản
                        </button>
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
                                <input class="form-control" name="user_name" id="user_name" type="text" />
                                @error('user_name')
                                    <label class="form-label text-danger">{{ $message }} </label>
                                @enderror
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label" for="full_name">Họ và tên:</label>
                                <input class="form-control" name="full_name" id="full_name" type="text" />
                                @error('full_name')
                                    <label class="form-label text-danger">{{ $message }} </label>
                                @enderror
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label" for="phone">Số điện thoại</label>
                                <input class="form-control" name="phone" id="phone" type="text" />
                                @error('phone')
                                    <label class="form-label text-danger">{{ $message }} </label>
                                @enderror
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control" name="email" id="email" type="text" />
                                @error('email')
                                    <label class="form-label text-danger">{{ $message }} </label>
                                @enderror
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label" for="password">Mật khẩu</label>
                                <input class="form-control" name="password" id="password" type="password" />
                                @error('password')
                                    <label class="form-label text-danger">{{ $message }} </label>
                                @enderror
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label" for="re_enter_password">Nhập lại mật khẩu</label>
                                <input class="form-control" name="re_enter_password" id="re_enter_password"
                                    type="password" />
                                @error('re_enter_password')
                                    <label class="form-label text-danger">{{ $message }} </label>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="address">Địa chỉ:</label>
                                <input class="form-control" name="address" id="address" type="text" />
                                @error('address')
                                    <label class="form-label text-danger">{{ $message }} </label>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Thêm ảnh</h6>
                        @error('img')
                            <label class="form-label text-danger">{{ $message }} </label>
                        @enderror
                    </div>
                    <div class="card-body">
                        <div class="dropzone dropzone-multiple p-0" id="dropzoneMultipleFileUpload"
                            data-dropzone="data-dropzone">
                            <div class="dz-message" data-dz-message="data-dz-message">
                                <img class="me-2" src="{{ asset('theme/admin/img/icons/cloud-upload.svg') }}"
                                    width="25" alt="" />
                                <span class="d-none d-lg-inline">Kéo hình ảnh của bạn vào đây<br />hoặc, </span>
                                <span class="btn btn-link p-0 fs-10">Duyệt</span>
                            </div>
                            <div class="dz-preview dz-preview-multiple m-0 d-flex flex-column">
                                <div class="d-flex media align-items-center mb-3 pb-3 border-bottom btn-reveal-trigger">
                                    <img class="dz-image" src="{{ asset('theme/admin/img/icons/cloud-upload.svg') }}"
                                        alt="..." data-dz-thumbnail="data-dz-thumbnail" />
                                    <div class="flex-1 d-flex flex-between-center">
                                        <div>
                                            <h6 data-dz-name="data-dz-name"></h6>
                                            <div class="d-flex align-items-center">
                                                <p class="mb-0 fs-10 text-400 lh-1" data-dz-size="data-dz-size"></p>
                                                <div class="dz-progress">
                                                    <span class="dz-upload" data-dz-uploadprogress=""></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown font-sans-serif">
                                            <button
                                                class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none"
                                                type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <span class="fas fa-ellipsis-h"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end border py-2">
                                                <a class="dropdown-item" href="#!"
                                                    data-dz-remove="data-dz-remove">Xóa
                                                    File</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="file" name="img" id="hidden-files" style="display: none;">

                    </div>

                </div>

            </div>
            <div class="col-lg-4 ps-lg-2">
                <div class="sticky-sidebar">
                    <div class="card mb-3">
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Quyền hạn</h6>
                        </div>
                        <div class="card-body">
                            <div class="row gx-2">
                                <div class="col-12 mb-3">
                                    <div id="role-checkboxes">
                                        @foreach($roles as $role)
                                            <div class="form-check">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input role-checkbox"
                                                    id="role-{{ $role->id }}"
                                                    name="roles[]"
                                                    value="{{ $role->id }}"
                                                    data-role-name="{{ $role->name }}"
                                                >
                                                <label class="form-check-label" for="role-{{ $role->id }}">
                                                    @switch($role->name)
                                                        @case('super_admin')
                                                            Quản Trị Viên
                                                            @break
                                                        @case('comment_manager')
                                                            Quản lý bình luận.
                                                            @break
                                                        @case('coupon_manager')
                                                            Quản lý mã giảm giá.
                                                            @break
                                                        @case('category_manager')
                                                            Quản lý danh mục sản phẩm.
                                                            @break
                                                        @case('post_manager')
                                                            Quản lý bài viết.
                                                            @break
                                                        @case('product_manager')
                                                            Quản lý sản phẩm.
                                                            @break
                                                        @case('attribute_manager')
                                                            Quản lý thuộc tính sản phẩm.
                                                            @break
                                                        @case('tag_manager')
                                                            Quản lý tags.
                                                            @break
                                                        @case('ticket_manager')
                                                            Quản lý ticket hỗ trợ khách hàng.
                                                            @break
                                                        @case('banner_manager')
                                                            Quản lý banner.
                                                            @break
                                                        @case('order_manager')
                                                            Quản lý đơn hàng.
                                                            @break
                                                        @case('wallet_manager')
                                                            Quản lý ví và giao dịch.
                                                            @break
                                                        @case('customer_manager')
                                                            Quản lý khách hàng.
                                                            @break
                                                        @case('statistical_viewer')
                                                            Chỉ xem báo cáo và thống kê.
                                                            @break
                                                        @default
                                                            {{ $role->role_type }}
                                                    @endswitch
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            const roleCheckboxes = document.querySelectorAll('.role-checkbox');

                                            roleCheckboxes.forEach(checkbox => {
                                                checkbox.addEventListener('change', function () {
                                                    const isSuperAdmin = this.dataset.roleName === 'super_admin';
                                                    const isChecked = this.checked;

                                                    if (isSuperAdmin && isChecked) {
                                                        // Disable all other checkboxes
                                                        roleCheckboxes.forEach(cb => {
                                                            if (cb.dataset.roleName !== 'super_admin') {
                                                                cb.checked = false;
                                                                cb.disabled = true;
                                                            }
                                                        });
                                                    } else if (isSuperAdmin && !isChecked) {
                                                        // Enable all other checkboxes when Super Admin is unchecked
                                                        roleCheckboxes.forEach(cb => {
                                                            if (cb.dataset.roleName !== 'super_admin') {
                                                                cb.disabled = false;
                                                            }
                                                        });
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                    @error('roles_id')
                                        <label class="form-label text-danger">{{ $message }} </label>
                                    @enderror
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
    </form>
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
                        document.getElementById("create").submit();
                    } else {
                        // Nếu không có file trong Dropzone, submit form ngay lập tức
                        document.getElementById("create").submit();
                    }
                });
            }
        });
    </script>
@endsection
