@extends('wallet::layouts.css')

@section('content')
    <div class="container">
        <div class="text-center mb-4">
            <!-- Logo -->
            <img src="/path/to/logo.png" alt="Logo" class="logo mb-3">
            <!-- Heading -->
            <h3 class="text-primary">Kích hoạt ví </h3>
        </div>

        <!-- Status Bar -->
        <div class="status-bar d-flex justify-content-center mb-4">
            <ul class="wizard-nav">
                <li class="wizard-list-item">
                    <div class="list-item">
                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Seller Details">
                            <i class="bx bx-user-circle"></i>
                        </div>
                        <span> Thông tin cơ bản</span>
                    </div>
                </li>
                <li class="wizard-list-item ms-3">
                    <div class="list-item active">
                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Company Document">
                            <i class="bx bx-file"></i>
                        </div>
                        <span> Thông tin cá nhân</span>
                    </div>
                </li>
                <li class="wizard-list-item ms-3">
                    <div class="list-item">
                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Bank Details">
                            <i class="bx bx-edit"></i>
                        </div>
                        <span> Điều khoản sử dụng</span>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Card -->
        <div class="card">
            <div class="container-fluid">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
            <div class="card-body">
                <form class="needs-validation" method="POST" action="{{ route('ekyc.uploadkyc')  }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="id_number" class="form-label">Số CCCD</label>
                        <input type="text" class="form-control" id="id_number" value="{{ $info->id_number }}" name="id_number" pattern="\d{12}" maxlength="12" required>
                        <div class="invalid-feedback">Vui lòng nhập số CCCD</div>
                        <div class="valid-feedback"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="issue_date" class="form-label">Ngày Cấp</label>
                                <input class="form-control" type="date" id="example-date-input" value="{{ $info->issue_date }}" name="issue_date" required>
                                <div class="invalid-feedback">Vui lòng chọn ngày cấp</div>
                                <div class="valid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date_of_expiry" class="form-label">Ngày Hết Hạn</label>
                                <input class="form-control" type="date" id="example-date-input" value="{{ $info->date_of_expiry }}" name="date_of_expiry" required>
                                <div class="invalid-feedback">Vui lòng chọn ngày hết hạn</div>
                                <div class="valid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Nơi cấp</label>
                        <input type="text" class="form-control" id="phone" name="place_of_issue" value="{{ $info->place_of_issue }}" required>
                        <div class="invalid-feedback">Nơi cấp</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Quê Quán</label>
                        <input type="text" class="form-control" id="email" name="place_of_birth" value="{{ $info->place_of_birth }}" required>
                        <div class="invalid-feedback">Vui lòng nhập quê quán</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">CCCD Mặt trước</h4>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <div class="fallback">
                                                <input name="id_card_image_front" type="file" accept="image/png,image/jpeg" required>
                                                <div class="invalid-feedback">Vui lòng chọn ảnh</div>
                                            </div>
                                            <div class="dz-message needsclick">
                                                <div class="mb-3">
                                                    <i class="display-4 text-muted mdi mdi-cloud-upload"></i>
                                                </div>
                                                <h4>Bấm vào để tải ảnh lên</h4>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">CCCD Mặt sau</h4>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <div class="fallback">
                                                <input name="id_card_image_back" type="file" accept="image/png,image/jpeg" required>
                                                <div class="invalid-feedback">Vui lòng chọn ảnh</div>
                                            </div>
                                            <div class="dz-message needsclick">
                                                <div class="mb-3">
                                                    <i class="display-4 text-muted mdi mdi-cloud-upload"></i>
                                                </div>
                                                <h4>Bấm vào để tải ảnh lên.</h4>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        <button class="btn btn-primary w-100" type="submit">Tiếp tục</button>
                        </div>
                        <div  class="col-md-2">
                            <!-- Static Backdrop modal Button -->
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Bỏ qua
                            </button>

                            <!-- Static Backdrop Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Xác nhận bỏ qua</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Nếu bạn bỏ qua phần này thì bạn sẽ không thể thực hiện các chức năng sau đây</p>
                                            <ul>
                                                {{-- <li>Chuyển tiền</li> --}}
                                                <li>Nạp tiền</li>
                                                <li>Rút tiền</li>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">

                                                <a  href="{{ route('ekyc.step2skip') }}" class="btn btn-danger">Bỏ qua xác thực thông tin</a>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Quay lại xác thực</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        !(function() {
            "use strict";
            window.addEventListener(
                "load",
                function() {
                    var t = document.getElementsByClassName("needs-validation");
                    Array.prototype.filter.call(t, function(e) {
                        e.addEventListener(
                            "submit",
                            function(t) {
                                !1 === e.checkValidity() &&
                                    (t.preventDefault(), t.stopPropagation()),
                                    e.classList.add("was-validated");
                            },
                            !1
                        );
                    });
                },
                !1
            );
        })();
    </script>
    <script src="{{ Module::asset('wallet:libs/dropzone/dropzone-min.js') }}"></script>
@endsection
