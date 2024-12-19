@extends('wallet::layouts.css')

@section('content')
<div class="container">
    <div class="text-center mb-4">
        <!-- Heading -->
        <h3 class="text-primary">Kích hoạt ví điện tử</h3>
    </div>

    <!-- Status Bar -->
    <div class="status-bar d-flex justify-content-center mb-4">
        <ul class="wizard-nav">
            <li class="wizard-list-item">
                <div class="list-item active">
                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Seller Details">
                        <i class="bx bx-user-circle"></i>
                    </div>
                    <span> Thông tin cơ bản</span>
                </div>
            </li>
            <li class="wizard-list-item ms-3">
                <div class="list-item">
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
        </div>
        @yield('content')
        <div class="card-body">
            <form class="needs-validation" method="POST" action="{{ route('ekyc.uploadadress') }}" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="frist_name" class="form-label">Họ</label>
                            <input type="text" class="form-control" id="frist_name" value="{{ $info->frist_name }}" name="frist_name" required>
                            <div class="invalid-feedback">Vui lòng nhập họ</div>
                            <div class="valid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Tên</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $info->last_name }}" required>
                            <div class="invalid-feedback">Vui lòng nhập tên của bạn</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Ngày sinh</label>
                            <input class="form-control" type="date" id="example-date-input" name="date_of_birth" value="{{ $info->date_of_birth }}"   required>
                            <div class="invalid-feedback">Vui lòng chọn ngày sinh</div>
                            <div class="valid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="gender" class="form-label">Giới tính</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="">Chọn giới tính</option>
                            <option value="MALE">Nam</option>
                            <option value="FEMALE">Nữ</option>
                        </select>
                        <div class="invalid-feedback">Vui lòng chọn giới tính</div>
                        <div class="valid-feedback"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="phone" name="phone_number" value="{{ $info->phone_number }}" required>
                    <div class="invalid-feedback">Vui lòng nhập số điện thoại</div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                    <div class="invalid-feedback">Vui lòng nhập email</div>
                </div>
                <div class="mb-3">
                    <label for="place_of_residence" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" id="place_of_residence" name="place_of_residence" value="{{ $info->place_of_residence }}" required>
                    <div class="invalid-feedback">Vui lòng nhập địa chỉ</div>
                </div>
                <div class="mb-3">
                    <label for="nationality" class="form-label">Quốc Gia</label>
                    <select class="form-select" id="nationality" name="nationality" required>
                        <option value="VN" selected>Việt Nam</option>
                    </select>
                    <div class="invalid-feedback">Vui lòng Chọn quốc gia</div>
                </div>

                <button class="btn btn-primary w-100" type="submit">Tiếp tục</button>
            </form>
        </div>
    </div>
</div>

<script>
     !(function () {
        "use strict";
        window.addEventListener(
            "load",
            function () {
                var t = document.getElementsByClassName("needs-validation");
                Array.prototype.filter.call(t, function (e) {
                    e.addEventListener(
                        "submit",
                        function (t) {
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
@endsection
