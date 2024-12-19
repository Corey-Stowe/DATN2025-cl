@extends('wallet::layouts.master')
@section('content')
    <div class="container">
        @if ($returndata['vnp_ResponseCode'] == 00)
            <div class="d-flex justify-content-center">
                <i class="bx bx-check-circle text-success" style="font-size: 150px;"></i>
            </div>

            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h3 class="mt-3">Thanh toán thành công</h3>
                    <p class="text-muted">Cảm ơn bạn đã sử dụng ví tiền</p>
                </div>
            </div>
            <button class="btn btn-primary w-100" onclick="window.location.href='{{ route('wallet.index') }}'">Quay lại trang chủ</button>
            <div class="d-flex justify-content-center mt-2">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Thông tin giao dịch</h3>
                        <p class="card-text ">Mã giao dịch: <strong>{{ $returndata['vnp_TxnRef'] }}</strong></p>
                        <p class="card-text">Mã tham chiếu: <strong>{{ $returndata['vnp_BankTranNo'] }}</strong></p>
                        <p class="card-text">Số tiền: <strong>{{ number_format($returndata['Ammout'] / 100) }} VND</strong>
                        </p>
                        <p class="card-text">Phương thức thanh toán: <strong>{{ $returndata['vnp_CardType'] }}</strong></p>
                        <p class="card-text">Ngày khởi tạo: <strong>{{ $returndata['vnp_PayDate'] }}</strong></p>
                        <p class="card-text">Mã chain <strong>{{ $returndata['vnp_SecureHash'] }}</strong></p>
                    </div>
                </div>
            </div>
            @else
        <div class="d-flex justify-content-center">
            <i class="bx bx-x-circle text-danger" style="font-size: 150px;"></i>
        </div>

        <div class="d-flex justify-content-center">
            <div class="text-center">
                <h3 class="mt-3">Thanh toán thất bại </h3>
                @if ($returndata['vnp_ResponseCode'] == 24)
                <p class="text-muted">Giao dịch đã bị hủy bởi người dùng</p>
                @elseif ($returndata['vnp_ResponseCode'] == 12)
                <p class="text-muted">Thẻ/Tài khoản của bạn bị khóa.</p>
                @elseif ($returndata['vnp_ResponseCode'] == 07)
                <p class="text-muted">Hành vì gian lận giao dịch được phát hiện
                @elseif ($returndata['vnp_ResponseCode'] == 13)
                <p class="text-muted"> Bạn nhập sai mật khẩu xác thực giao dịch (OTP). Xin quý khách vui lòng thực hiện lại giao dịch.</p>
                @elseif ($returndata['vnp_ResponseCode'] == 51)
                <p class="text-muted"> Giao dịch không thành công do: Tài khoản của quý khách không đủ số dư để thực hiện giao dịch.</p>
                @endif
                </p>
                <button class="btn btn-primary" onclick="window.location.href='{{ route('wallet.index') }}'">Quay lại trang chủ</button>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center">Thông tin giao dịch</h3>
                    <p class="card-text ">Mã giao dịch: <strong>{{ $returndata['vnp_TxnRef'] }}</strong></p>
                    <p class="card-text">Mã tham chiếu: <strong>{{ $returndata['vnp_BankTranNo'] }}</strong></p>
                    <p class="card-text">Số tiền: <strong>{{ number_format($returndata['Ammout'] / 100) }} VND</strong></p>
                    <p class="card-text">Phương thức thanh toán: <strong>{{ $returndata['vnp_CardType'] }}</strong></p>
                    <p class="card-text">Ngày khởi tạo: <strong>{{ $returndata['vnp_PayDate'] }}</strong></p>
                    <p class="card-text text-muted">Request ID: <strong>{{ $returndata['vnp_SecureHash'] }}</strong></p>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
