@extends('wallet::layouts.css')

@section('content')
    <div class="container mt-5">
        <!-- Header -->
        <div class="text-center mb-4">
            <!-- Logo -->
            {{-- <img src="/path/to/logo.png" alt="Logo" class="logo mb-3"> --}}
            <!-- Heading -->
            <h3 class="text-primary" style="font-size: 1.5rem;">Chi tiết đơn thanh toán</h3>
        </div>

        <!-- Card -->
        <div class="card">
            <div class="card-body">
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
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <h5 class="text-primary">Thanh toán dịch vụ</h5>
                        <p class="text-muted">Bạn đang thanh toán đơn mua hàng</p>
                        <div class="status-bar d-flex justify-content-center mb-4">
                            <ul class="wizard-nav list-unstyled d-flex">
                                <!-- Wallet Icon -->
                                <li class="wizard-list-item me-3">
                                    <div class="list-item text-center">
                                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                            aria-label="Seller Details">
                                            <i class="bx bx-wallet-alt"></i>
                                            <p class="small m-0 text-nowrap">{{ $walletaccount->wallet_account_id }}</p>
                                        </div>
                                    </div>
                                </li>

                                <!-- Arrow Icon -->
                                <li class="wizard-list-item me-4 mt-3">
                                    <div class="list-item text-center">
                                        <i class="bx bx-right-arrow-alt"></i>
                                    </div>
                                </li>

                                <!-- Store Icon -->
                                <li class="wizard-list-item">
                                    <div class="list-item text-center">
                                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                            aria-label="Bank Details">
                                            <i class="bx bx-store-alt lg"></i>
                                            <p class="small m-0 text-nowrap">{{ $data['shop_name'] }}</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <p>Số tiền thanh toán: <strong>{{ number_format($data['ammount']) }} VNĐ</strong></p>
                        <p>Mã đơn hàng: <strong>{{ $data['order_id'] }}</strong></p>
                        <p>Mô tả: <strong>{{ $data['shop_desciprtion'] }}</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <p class="text-center mt-3">Thông tin tài khoản thanh toán</p>
            <div class="card-body">
                <i class="bx bx-wallet-alt"></i>
                <p> Mã Ví: <strong> {{ $walletaccount->wallet_account_id }} </strong> </p>
                <p> Số dư <strong>{{ number_format($walletaccount->wallet_balance_available) }} VNĐ</strong></p>
                @if ($walletaccount->wallet_balance_available >= $data['ammount'])
                @else
                    <p class="text-danger"> <strong>Số dư không đủ để thanh toán !</strong></p>
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-between mt-3">
            <!-- Modal trigger button -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalId">
                Hủy
            </button>

            <!-- Modal Body -->
            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
            <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
                role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">
                                Hủy giao dịch
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">Bạn có chắc chắn hủy giao dịch không </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                                Tiếp tục giao dịch
                            </button>
                            <a href="{{ route('wallet.pay.cancel',['id'=>$id]) }}" type="button" class="btn btn-danger">Hủy giao dịch</a>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('wallet.pay.otp') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $id }}">
                @if ($walletaccount->wallet_balance_available >= $data['ammount'])
                    <button type="submit" class="btn btn-success">Xác nhận thanh toán</button>
                @else
                    <a href="{{ route('wallet.topup') }}" class="btn btn-danger">Nạp thêm</a>
                @endif
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        (function() {
            "use strict";
            window.addEventListener("load", function() {
                var forms = document.getElementsByClassName("needs-validation");
                Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener("submit", function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add("was-validated");
                    }, false);
                });
            }, false);
        })();
    </script>
    <script src="{{ Module::asset('wallet:libs/dropzone/dropzone-min.js') }}"></script>
@endsection
